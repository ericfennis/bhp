<template>
    <main-layout>
        <div class="container-fluid">
            <div class="row">
            
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <form id="search">
                            <input type="text" v-model="searchString" placeholder="Zoek naar 'Kapper'" />
                       
                            <nav v-if="searchString.length == 0">
                                <ul class="nav nav-tabs">
                                    <li><a href="#" :class="{ active: visibility == 'all' }" @click="selectTab('all')">Alles</a></li>
                                    <li><a href="#" :class="{ active: visibility == 'companies' }" @click="selectTab('companies')">Bedrijven</a></li>
                                    <li><a href="#" :class="{ active: visibility == 'people' }" @click="selectTab('people')">Medewerkers</a></li>
                                    <li><a href="#" :class="{ active: visibility == 'education' }" @click="selectTab('education')">Onderwijsinstellingen</a></li>
                                </ul>
                            </nav>
        
                        </form>
                        <ul class="list-group" v-for="item in filteredData">
                            <li class="list-group-item" @click="getWalkpath(item)">
                                <h4 v-if="item.branch"><b>{{item.name}}</b></h4>
                                <h4 v-else>{{item.name}}</h4>

                                <i v-if="item.branch">{{item.branch}}</i>
                                <i v-if="item.company">{{item.company}}</i>
                            </li>
                       
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main-layout>
</template>

<script>
    import MainLayout from '../Main.vue'

    var STORAGE_KEY = 'list-vuejs'
    export default {
        components: {
            MainLayout
        },
        data() {
            return {
                searchString: "",
                all: [],
                visibility: "all",
                data: {
                    people:[],
                    companies:[],
                    education:[]
                },
            }
        },
        beforeCreate() {
            console.log('Component ready.');
            this.all = localStorage.getItem(STORAGE_KEY);
        },
        created() {
            
            this.getAll();
            this.getJSON();
            //console.log(this.$parent.$root.hans);
        },

        computed: {
        // A computed property that holds only those articles that match the searchString.
            filteredData: function () {
                var results_array = this.all,
                    searchString = this.searchString;


                if(!searchString){
                    if(this.visibility == 'all') {
                        return results_array;
                    } else {
                        return this.data[this.visibility];
                    }
                }

                searchString = searchString.trim().toLowerCase();

                if (searchString) {
                    results_array = this.all.filter(function (row) {
                      return Object.keys(row).some(function (key) {
                        return String(row[key]).toLowerCase().indexOf(searchString) > -1
                      })
                    })
                  }
                // Return an array with the filtered data.
                return results_array;
            },
            
        },
        methods: {
            getJSON: function () {
                this.$http.get('/api/list').then((response) => {
                //combine firstname and surname to name
                this.data = response.body;
                
                this.getAll();
                }, (response) => {
                    console.error('Hij doet het niet');
                });
                
            },
            getAll: function() {

                var companies = this.data.companies,
                    people = this.data.people,
                    all = people.concat(companies);
                all = all.sort(function(a, b) {
                    var a = a.name.toUpperCase();
                    var b = b.name.toUpperCase();
                    return (a < b) ? -1 : (a > b) ? 1 : 0;
                });

                this.all = all;
                localStorage.setItem(STORAGE_KEY, JSON.stringify(this.all));
            },
            getWalkpath: function(item) {
                this.$parent.$root.getWalkpath(item);
                //console.log(this);
                // if(item.company_id) {
                //     console.log(item.company_id);
                // } else if(item.id) {
                //     console.log(item.id);
                // }
            },
            selectTab: function(tab) {
                this.visibility = tab;
            }
        },

    }
    
   

</script>
