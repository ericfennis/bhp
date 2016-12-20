<template>
    <main-layout>

                <aside>
                    <div class="panel panel-default">
                        <h1 class="welkom">welkom bij de</h1>
                        <img src="/img/logobhp.svg" class="logobhp" alt="Logo BHP">
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
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD

=======
                    <open-layers keep-alive></open-layers>
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
                </section>
           

    </main-layout>
</template>

<script>
    //console.log(this);
    import MainLayout from '../Main.vue'
<<<<<<< HEAD

=======
    import OpenLayers from '../components/OpenLayers.vue';
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
    import VLink from '../components/VLink.vue'

    export default {
        components: {
                MainLayout,
                VLink,
<<<<<<< HEAD

=======
                OpenLayers
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
        },
        data() {
            return {
                events:[

                        
                ]

            }
        },
<<<<<<< HEAD
        created() {
=======
       created() {
      
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
