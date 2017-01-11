<template>
    <div id="clock">{{ hours }}:{{ minutes }}</div>
</template>

<script>
    
    var now = new Date();
    function getZeroPad (n) {
      return (parseInt(n, 10) >= 10 ? '' : '0') + n
    }
    export default {
        data() {
            return {
                hours: now.getHours(),
                minutes: getZeroPad(now.getMinutes()),

            }
        },
        mounted() {
            setInterval(this.updateDateTime, 1000);
        },
        methods: {
            updateDateTime () {
                now = new Date();
                this.hours = now.getHours()
                this.minutes = getZeroPad(now.getMinutes()) 
            }
        }
    }
</script>
