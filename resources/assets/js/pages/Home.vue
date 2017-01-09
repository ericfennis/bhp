<template>
    <main-layout>

                <aside>
                    <div class="panel panel-default">
                        <h1 class="welkom">welkom bij de</h1>

                        <img src="/img/logobhp.svg" class="logobhp" alt="Logo BHP">
                        
                        <ul id="calendar">
                            <li class="event" v-for="Event in events" @click="toggleEvent(Event)" v-bind:class="{ active: active == Event }">
                                <div class="event-date-time">
                                    <div class="event-dt-wrap">
                                        <div class="event-date">
                                            {{ Event.date }}
                                        </div>
                                        <div class="event-time">
                                            {{ Event.time }}u
                                        </div>
                                    </div>
                                </div>
                                <div class="event-body">
                                    <h3 class="event-title">
                                        {{ Event.title }}
                                    </h3>
                                    <p class="event-desc">
                                        {{ Event.desc }}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                </aside>

                <section>
                    <div class="overlay">
                        <div class="centered">
                            <div class="row">

                             
                                <h1 class="maptitel">bedrijven &amp; Personen zoeken</h1>
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

    var STORAGE_KEY = 'events-vuejs'
    export default {
        components: {
                MainLayout,
                VLink
        },
        data() {
            return {
                events:[
                        
                ],
                active: ''
            }
        },
        beforeMount() {
            this.events = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
        },
        created() {
           this.getEvents();
           var called = false;
           if(!called) {
                setInterval(function () {
                    this.getEvents();
                    this.toggleEvent();
                }.bind(this), 30000);
                called = true;
           }
        },
        mounted() {
            console.log('Component ready.');
        },
        methods: {
            getEvents: function () {
                this.$http.get('/api/events').then((response) => {
        
                this.events = response.body;
                localStorage.setItem(STORAGE_KEY, JSON.stringify(this.events));

                }, (response) => {
                    console.error('Hij doet het niet');
                });
            },
            toggleEvent: function (event) {
                if(this.active == event) {
                    this.active == '';
                } else {
                    this.active = event;
                }
                
            }
        },
    }
</script>
