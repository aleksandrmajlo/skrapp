<template>
    <div class="mb-3">
        <button :disabled="disabled" @click.prevent="SendBank" class="btn btn-outline-info">Опросить банки</button>
    </div>
</template>
<script>
    export default {
        name: "ContactBank",
        props: ['contact_id'],
        data() {
            return {
                disabled: false
            }
        },
        methods: {
            SendBank() {
                this.disabled = true;
                axios
                    .post("/ajax/contact/sendBankContacDuplicate", {contact_id: this.contact_id})
                    .then((response) => {
                        this.$swal({
                            icon: 'success',
                            text: 'Заявка отправлена!',
                        });
                        $('#resultBank').removeClass('d-none');
                    })
                    .catch((err) => {
                    })
                    .then(() => {
                    });

            }
        }
    }
</script>
