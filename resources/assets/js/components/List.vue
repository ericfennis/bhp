<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <ul class="list-group" v-for="company in list">
                        <li class="list-group-item">
                            {{company.name}}
                            <strong @click="delete(company.name)">x</strong>
                        </li>
                    </ul>
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
                message:'afasdfasdf'
            }
        },
        created() {
            this.getList();
        },
        methods: {
            getList: function() {
                var dt = this
                var request = new XMLHttpRequest();
                request.open('GET', '/api/companies', true);
                request.onload = function() {
                  if (request.status >= 200 && request.status < 400) {
                    var data = JSON.parse(request.responseText);
                    dt.list = data;
                  } else {
                    console.log('fackkkkk');
                  }
                };
                request.onerror = function() {
                  console.log('fackkkkk');
                };

                request.send();
            },
            delete: function(company) {
                this.list.$remove(company);
            }
        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
