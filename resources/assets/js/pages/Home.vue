<template>
    <main-layout>

                <aside>
                    <div class="panel panel-default">
                        <h1 class="welkom">welkom bij de</h1>

                        <img src="/img/logobhp.svg" class="logobhp" alt="Logo BHP">

                    </div>

                </aside>

                <section>
                    <div class="overlay">
                        <div class="centered">
                            <div class="row">

                             
                                <h1 class="maptitel">bedrijven & Personen zoeken</h1>
                                    <p class="mapparagraph">Ga verder naar de plattegrond om de locatie te vinden van het bedrijf of persoon waar u naar op zoek bent.</p>
                         
                                    <v-link href="/list" class="btn btn-lg btn-block btn-primary plattegrond-button">Klik hier voor de plattegrond</v-link>

                            </div>
                        </div>
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
       created() {
      
        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
