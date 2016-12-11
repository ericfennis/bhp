<template>
    <main-layout>

                <aside>
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
                        <ul id="results" class="list-group" >
                            <li class="list-group-item"  v-for="(item,index) in filteredData" @click="getWalkpath(item)" v-bind:class="{ active: active == item }">
                                


                                <img v-if="item.profilepicture" width="64" height="64" v-bind:src="item.profilepicture"/>
                                <img v-else width="64" height="64" v-bind:src="item.logo"/>



                                <h4 v-if="item.branch"><b>{{item.name}}</b></h4>
                                <h4 v-else>{{item.name}}</h4>

                                <i v-if="item.branch">{{item.branch}}</i>
                                <i v-if="item.company">{{item.company}}</i>
                                
                                <div v-if="active == item" class="item-body">
                                    <div class="info-location" v-if="item.room_number && item.building">Cel: {{ item.building+item.room_number }}</div>
                                    <hr>
                                    <div class="info-telephone" v-if="item.room_number">
                                        {{ item.telephone }}
                                    </div>
                                    <div class="info-email" v-if="item.room_number">
                                        {{ item.email }}
                                    </div>
                                </div>
                            </li>
                       
                        </ul>
                    </div>
                </aside>
                <section>
                    <div class="map">
                        
                    </div>
                </section>
        <footer>
            <v-link href="/">Terug</v-link>
        </footer>
    </main-layout>
</template>

<script>
    import MainLayout from '../Main.vue'
    import VLink from '../components/VLink.vue'

    var STORAGE_KEY = 'list-vuejs'
    export default {
        components: {
                MainLayout,
                VLink
        },
        data() {
            return {
                searchString: "",
                all: [],
                visibility: "all",
                active: null,
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
                this.active = item;
                //console.log(item);
                
            },
            selectTab: function(tab) {
                this.visibility = tab;
            },
            
        },

    }
    
   

</script>
