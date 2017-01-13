<template>
    <main-layout>
                <aside>
                    <div class="panel panel-default">
                        <form id="search" v-bind:class="{ filled: searchString.length !== 0 }">
                            <input type="text" @click="selectTab('all'),screenKeyboard = true" v-model="searchString" placeholder="Zoek naar bv: 'Kapper, naam, bedrijf etc.'" />
                            <div class="search-button" role="button" @click="searchString = '',clearKeyboard()"></div>
       
                            

                            <nav v-if="searchString.length == 0">
                                <ul class="nav nav-tabs">
                                    <li><a href="#" :class="{ active: visibility == 'all' }" @click="selectTab('all')">Alle</a></li>
                                    <li><a href="#" :class="{ active: visibility == 'companies' }" @click="selectTab('companies')">Bedrijven</a></li>
                                    <li><a href="#" :class="{ active: visibility == 'people' }" @click="selectTab('people')">Medewerkers</a></li>
                                    <li><a href="#" :class="{ active: visibility == 'education' }" @click="selectTab('education')">Scholen</a></li>
                                </ul>
                            </nav>

                        </form>
                        <ul id="results" class="list-group">
                            <li class="result-item"  v-for="(item, i) in filteredData" @click="getWalkpath(item)" v-bind:style="'animation-delay:'+i+1*12+'ms'" v-bind:key="i" v-bind:class="{ active: active == item }">
                        
                                <div class="item-image">
                                    <img v-if="item.profilepicture" width="64" height="64" v-bind:src="item.profilepicture"/>
                                    <img v-else width="64" height="64" v-bind:src="item.logo"/>
                                    <img v-else width="64" height="64" src="http://placehold.it/64x64"/>
                                </div>
                                <div class="item-body">
                                    <h4 v-if="item.branch"><b>{{item.name}}</b></h4>
                                    <h4 v-else>{{item.name}}</h4>

                                    <!-- <p v-if="item.branch">
                                    {{#if item.branch.lengt}}
                                    {{ item.branch }}
                                    </p>
                                    <p v-if="item.company"
                                    >{{ item.company }}
                                    </p> -->
                        
                                        <p v-if="item.branch">
                                            {{ item.branch }}
                                        </p>

                                        <p v-else-if="item.company">   
                                            {{ item.company }}
                                        </p>
                                        <p v-else>&nbsp;</p>
                        
                                    <transition name="collapse">
                                        <div v-if="active == item" class="item-collapse">
                                            <div class="info-location" v-if="item.room_number && item.building">Cel: {{ item.building+item.room_number }}</div>
                                            <div class="info-telephone" v-if="item.room_number">
                                                {{ item.telephone }}
                                            </div>
                                            <div class="info-email" v-if="item.room_number">
                                                {{ item.email }}
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                                



                                
                                
                                
                            </li>

                        </ul>
                        <footer>
                            <v-link backHome="true" href="/" class="button_return">Terug</v-link>
                        </footer>
                    </div>

                </aside>
                <section>
                    <footer>
                          <div class="legenda_container">
                            <div class="legenda_text">
                            <h2>Legenda</h2>
                            </div>
                            <div class="legenda_wrapper">
                              <ul class="legend">
                                    <li class="beginpunt">U bevindt zich hier</li>
                                    <li class="eindpunt">Eindpunt</li>
                              </ul>
                              <ul class="legend">
                                <li class="trap">Trap</li>
                                <li class="lift">Lift</li>
                                <!-- <li class="herkenningspunt">Herkenningspunt</li> -->
                              </ul>
                              <ul class="legend">
                                
                                <li class="wc">WC</li>
                              </ul>
                          </div>
                    </footer>
                </section>
                <keyboard :class="{ show: screenKeyboard == true }" @close="screenKeyboard = false" v-model="searchString"
    :layouts="[
        '{close:close}|1234567890{delete:backspace}|qwertyuiop|asdfghjkl|zxcvbnm|{space:space}'
    ]"
></keyboard>

        <div v-if="screenKeyboard" @click="screenKeyboard = false" class="overlay close-keyboard">

        </div>

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
                screenKeyboard: false,
                data: {
                    people:[],
                    companies:[],
                    education:[]
                },
            }
        },
        beforeMounted() {
            this.all = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            console.log('Component ready.');
            
        },
        created() {
            this.getAll();
            this.getJSON();
        },
        beforeCreated() {
            this.all = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
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
                this.$root.getWalkpath(item);
                this.active = item;
                //console.log(item);

            },
            selectTab: function(tab) {
                this.visibility = tab;
                this.active = null;
            },
            clearKeyboard:function () {
                this.$children[0].$children[2].clear();
            }
        },

    }



</script>
