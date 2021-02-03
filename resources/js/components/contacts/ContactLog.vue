<template>
    <div>
        <div class="row" v-for="(contactlog,index) in contactlogs" :key="index">
            <div class="col-md-3">
                <p class="text-bold">
                    {{contactlog.date}} {{contactlog.user}}
                </p>

            </div>
            <div class="col-md-1">
                {{contactlog.type}}
            </div>
            <div class="col-md-4">
                <h5>Старые данные</h5>
                <pre>
                {{contactlog.input}}
            </pre>
            </div>
            <div class="col-md-4">
                <h5>Обновленные</h5>
                <pre>
                {{contactlog.input_new}}
            </pre>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContactEdit",
        props: ['id'],
        data() {
            return {
                contactlogs: [],
            }
        },
        created() {
            axios
                .post("/ajax/contacts/log", {id: this.id})
                .then((response) => {
                    this.contactlogs = response.data.contactlogs
                    console.log(response.data);
                })
                .catch((err) => {
                })
                .then(() => {
                });
        }
    }
</script>
