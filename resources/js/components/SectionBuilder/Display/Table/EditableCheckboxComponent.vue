<template>
    <div class="text-center">
        <div :class="{
                'd-inline-block p-1': true,
                'bg-danger': this.error,
                'bg-success': this.success
             }"
        >
            <i v-if="loading" class="fas fa-circle-notch fa-spin"></i>
            <input v-else type="checkbox" v-model="isChecked" @change="toggleField">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "EditableCheckboxComponent",
        props: ['field', 'value', 'url'],
        data: function () {
            return {
                'isChecked': this.value,
                'loading': false,
                'error': false,
                'success': false
            }
        },
        methods: {
            toggleField: function () {
                this.loading = true;
                this.error = false;
                this.success = false;

                let field = this.field;
                let value = this.isChecked;

                axios.post(this.url, {
                    field: field,
                    value: value
                })
                    .then((response) => {
                        this.isChecked = response.data.data.model[this.field];
                        this.success = true;
                        this.loading = false;
                    })
                    .catch((error) => {
                        this.isChecked = !value;
                        this.error = true;
                        this.loading = false;
                    })
            }
        }
    }
</script>

<style scoped>
    input[type="checkbox"] {
        cursor: pointer;
    }

    .d-inline-block {
        width: 26px;
        height: 26px;
        padding: 4px;
        border-radius: 3px;
    }
</style>
