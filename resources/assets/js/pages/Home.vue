<template>
    <main-layout>



                <aside>
                    <div class="panel panel-default">
                        <h1 class="welkom">welkom bij de</h1>
                    </div>
                </aside>

                <section>
                    <div class="centered">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <v-link href="/list" class="btn btn-lg btn-block btn-primary">Bekijk de Plattegrond</v-link>
                            </div>
                        </div>
                    </div>
                    <div class="map">
                        
                    </div>
                </section>


    </main-layout>
</template>

<script>
    //console.log(this);
    import MainLayout from '../Main.vue'
    import VLink from '../components/VLink.vue'

    export default {
        components: {
                MainLayout,
                VLink
        },
        data() {
            return {
                events:[

                        
                ]

            }
        },
       ready() {

          console.log('shfsdghiaosd')

        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
