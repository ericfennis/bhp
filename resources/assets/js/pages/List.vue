<template>
    <main-layout>
                <aside>
                    <div class="panel panel-default">

                        <form id="search" v-bind:class="{ filled: searchString.length !== 0 }">
                            <input type="text" @click="selectTab('all'),screenKeyboard = true" v-model="searchString" placeholder="Zoek naar bv: 'Kapper, naam, bedrijf etc.'" />

                            <div class="btn btn-primary" role="button" @click="searchString = '',clearKeyboard()">X</div>
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
                        <footer>
                            <v-link href="/" class="button_return">wtf is dit</v-link>
                        </footer>
                    </div>

                </aside>
                <section>
                    <footer>
                        <div class="contrast">
                          <div class="legenda_container">
                            <div class="legenda_text">
                            <h2>Legenda</h2>
                            </div>
                            <div class="legenda_wrapper">
                              <ul class="legend">
                                <li class="eindpunt">Eindpunt</li>
                                <li class="trap">Trap</li>
                                <li class="herkenningspunt">Herkenningspunt</li>
                              </ul>
                              <ul class="legend">
                                <li class="lift">Lift</li>
                                <li class="wc">WC</li>
                              </ul>
                          </div>
                        </div>
                    </footer>
                </section>


                <keyboard :class="{ show: screenKeyboard == true }" v-model="searchString"
    :layouts="[
        '{close:close}|1234567890{delete:backspace}|qwertyuiop|asdfghjkl|zxcvbnm|{space:space}'
    ]"></keyboard>


        <div v-if="screenKeyboard" @click="screenKeyboard = false" class="overlay close-keyboard">

        </div>

    </main-layout>
</template>

<script>
    import MainLayout from '../Main.vue'
    import VLink from '../components/VLink.vue'


    var STORAGE_KEY = 'list-vuejs'
    var list_vue = "";
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
        beforeCreate() {
            console.log('Component ready.');
            this.all = localStorage.getItem(STORAGE_KEY);
        },
        created() {
            this.getAll();
            this.getJSON();
            list_vue = this;
        },
        mounted() {
            console.log(this);
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
            },
            clearKeyboard:function () {
                this.$children[0].$children[2].clear();
            },
            hideKeyboard: function() {
                // if(this.screenKeyboard == true) {
                //     this.screenKeyboard == false;
                // }

                console.log("sfkjasfkjasbkfb");
            }
        },

    }



</script>
