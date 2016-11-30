<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                   {{message}}
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
       ready() {

          // GET /someUrl
          this.$http.get('/api/companies').then((response) => {
              console.log('hello world');
          }, (response) => {
              // error callback
          });

        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
