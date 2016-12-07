<template>
    <main-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <h1>Welkom bij de Blokhuispoort</h1>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="centered">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <v-link href="/list" class="btn btn-lg btn-block btn-primary">Bekijk de Plattegrond</v-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

                ],
                message:'afasdfasdf'
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
