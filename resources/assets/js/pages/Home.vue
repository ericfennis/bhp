<template>
    <main-layout>

                <aside>
                    <div class="panel panel-default">
                        <h1 class="welkom">welkom bij de</h1>
<<<<<<< HEAD
                        <img src="/img/logobhp.svg" class="logobhp" alt="Logo BHP">
=======
                    </div>
>>>>>>> peter
                </aside>

                <section>
                    <div class="overlay">
                        <div class="centered">
                            <div class="row">
<<<<<<< HEAD
                            <p id="clock">HH:MM</p>  
                                <h1 class="maptitel">bedrijven & Personen zoeken</h1>
                                    <p class="mapparagraph">Ga verder naar de plattegrond om de locatie te vinden van het bedrijf of persoon waar u naar op zoek bent.</p>
                                <div class="col-md-4 col-md-offset-4">
                                    <v-link href="/list" class="btn btn-lg btn-block btn-primary">KLIK HIER VOOR DE PLATTEGROND</v-link>
=======
                                <div class="col-md-4 col-md-offset-4">
                                    <v-link href="/list" class="btn btn-lg btn-block btn-primary">Bekijk de Plattegrond</v-link>
>>>>>>> peter
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
=======
                    <open-layers keep-alive></open-layers>
>>>>>>> peter
                </section>
           

    </main-layout>
</template>

<script>
    //console.log(this);
    import MainLayout from '../Main.vue'
    import OpenLayers from '../components/OpenLayers.vue';
    import VLink from '../components/VLink.vue'

    export default {
        components: {
                MainLayout,
                VLink,
<<<<<<< HEAD
=======
                OpenLayers
>>>>>>> peter
        },
        data() {
            return {
                events:[

                        
                ]

            }
        },
       created() {
      
        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
