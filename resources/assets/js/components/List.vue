<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <form id="search">
                        <input type="text" v-model="searchString" placeholder="Enter your search terms" />
                   
                        <nav>
                            <ul class="filters">
                                <li><a href="#/all" :class="{ selected: visibility == 'all' }">Alles</a></li>
                                <li><a href="#/companies" :class="{ selected: visibility == 'companies' }">Bedrijven</a></li>
                                <li><a href="#/people" :class="{ selected: visibility == 'people' }">Medewerkers</a></li>
                                <li><a href="#/education" :class="{ selected: visibility == 'education' }">Onderwijsinstellingen</a></li>
                            </ul>
                        </nav>
    
                    </form>
                   <!--  <nav>
                        <ul>
                            <li>Alle</li>
                            <li>Bedrijven</li>
                            <li>Medewerkers</li>
                            <li>Onderwijsinstellingen</li>
                        </ul>
                    </nav> -->
                    <ul class="list-group" v-for="item in filteredData">
                        <li class="list-group-item">
                            <div>{{item.name}}</div>
                            <i v-if="item.branch">{{item.branch}}</i><br>
                            <i v-if="item.company_id">{{companyName(item.company_id)}}</i>
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
    var tabs = {
        all: function() {

        },
        companies: function() {

        },
        people: function() {

        },
        education: function() {

        }
    }

    export default {
        data() {
            return {
                searchString: "",
                visibility: "All",
                data: {
                    all: [],
                    people:[],
                    companies:[],
                    education:[]
                }
            }
        },
        beforeMount() {
            console.log('Component ready.');
            this.getPeople();
            this.getCompanies();
            
        },
        Mounted() {
           
           //this.getEducation();
           
                   },

        filters: {
            pluralize: function (n) {
            return n === 1 ? 'item' : 'items'
            }
        },
        computed: {
        // A computed property that holds only those articles that match the searchString.
            filteredData: function () {
                var results_array = this.data.all,
                    searchString = this.searchString,
                    searchAll = this.data.all;//this.people.concat(this.list);


                if(!searchString){
                    return results_array;
                }

                searchString = searchString.trim().toLowerCase();

                // results_array = searchAll.filter(function(item){
                //     if((item.name.toLowerCase().indexOf(searchString)||item.branch.toLowerCase().indexOf(searchString)) !== -1){
                //         return item;
                //     }
                // })

                if (searchString) {
                    results_array = searchAll.filter(function (row) {
                      return Object.keys(row).some(function (key) {
                        return String(row[key]).toLowerCase().indexOf(searchString) > -1
                      })
                    })
                  }
                // Return an array with the filtered data.
                return results_array;
            },
            selectTab: function() {
                var output = this.data.all;
            }
        },
        methods: {
            getCompanies: function() {
                this.$http.get('/api/companies').then((response) => {
                this.data.companies = response.body;
                this.getEducation();
                }, (response) => {
                    console.error('Hij doet het niet');
                });
            },
            getPeople: function() {
                this.$http.get('/api/people').then((response) => {
                    //combine firstname and surname to name
                    for (var i = 0; i < response.body.length; i++) {
                    
                        //response.body[i].push({name: });
                        response.body[i].name = response.body[i].firstname + ' ' + response.body[i].surname;
                    }
                this.data.people = response.body;
                }, (response) => {
                    console.error('Hij doet het niet');
                });
                
            },
            getEducation: function() {
                var companies = this.data.companies,
                    education = [];
            

                for(var i = 0; i < companies.length; i++) {
                    if(companies[i].branch == "onderwijsinstelling") {
                        education.push(companies[i]);

                    }
                }
                this.data.education = education;
                this.getAll();
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
                this.data.all = all;
            },
            // deleteItem: function(item) {
            //     Vue.delete(this.list, item);
            //     console.log(item);
            // },
            companyName: function (id) {

                var companies = this.data.companies;

                for(var company in companies) {
                    console.log(company.id);
                    if(company.id == id){
                        return company.name;
                    }
                }

            },
            test: function() {
                console.log('test');
            }
        },

    }
    function onHashChange () {
      var visibility = window.location.hash.replace(/#\/?/, '')
      if (filters[visibility]) {
        app.visibility = visibility
      } else {
        window.location.hash = ''
        app.visibility = 'all'
      }
    }

</script>
