<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <form id="search">
                    <input type="text" v-model="searchString" placeholder="Enter your search terms" />
                </form>
                    <ul class="list-group" v-for="company in filteredData">
                        <li class="list-group-item">
                            {{company.name}}
                            <a href="#" @click="deleteItem(company)"><strong>x</strong></a>
                        </li>

                    </ul>
                    <a href="#" @click="test()"><strong>x</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //console.log(this);
    export default {
        data() {
            return {
                list:[],
                searchString: "",
                people:[
                    {
                        "name": "Geert"
                    },
                    {
                        "name": "Peter"
                    },
                    {
                        "name": "frits" 
                    },
                    {
                        "name": "Freek"
                    },
                    {
                        "name": "Filip"
                    },
                    {
                        "name": "Matthijs"
                    },
                    {
                        "name": "Harm"
                    },

                ]
            }
        },
        created() {
           this.getList();
        },
        computed: {
        // A computed property that holds only those articles that match the searchString.
            filteredData: function () {
                var results_array = this.list,
                    searchString = this.searchString,
                    searchAll = this.people.concat(this.list);


                if(!searchString){
                    return results_array;
                }

                searchString = searchString.trim().toLowerCase();

                results_array = searchAll.filter(function(item){
                    if(item.name.toLowerCase().indexOf(searchString) !== -1){
                        return item;
                    }
                })

                // Return an array with the filtered data.
                return results_array;
            }
        },
        methods: {
            getList: function() {
                this.$http.get('/api/companies').then((response) => {
                this.list = response.body;
                }, (response) => {
                    console.error('Hij doet het niet');
                });

            },
            // deleteItem: function(item) {
            //     Vue.delete(this.list, item);
            //     console.log(item);
            // },
            test: function() {
                console.log('test');
            }
        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
