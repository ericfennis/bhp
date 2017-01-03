<template>
    <div id="clock">{{ hours }}:{{ minutes }}</div>
</template>

<script>
    let now = new Date();
    export default {
        data() {
            return {
                hours: now.getHours(),
                minutes: now.getMinutes(),

            }
        },
        mounted() {
            setInterval(this.updateDateTime, 1000);
        },
        methods: {
            updateDateTime () {
                this.hours = now.getHours()
                this.minutes = now.getMinutes() 
            }
        }
    }
</script>
