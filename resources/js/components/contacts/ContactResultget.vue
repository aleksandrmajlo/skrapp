<template>
  <div id="resultBank" class="d-none">
      <button :disabled="disabled" @click.prevent="ResultBank" class="btn  btn-primary">Получить результат</button>
  </div>
</template>

<script>
    export default {
        name: "ContactResultget",
        data(){
            return {
                disabled:false
            }
        },
        methods:{
            ResultBank(){
                this.disabled=true;
                axios
                    .get("/cron_statusreport")
                    .then((response) => {

                    })
                    .catch((err) => {

                    })
                    .then(() => {
                        location.reload();
                    });

            }
        }
    }
</script>

