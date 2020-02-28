<template>
    <div class="text-center">
        <i v-if="loading" class="fas fa-circle-notch fa-spin"></i>
        <input v-else type="checkbox" class="form-check-input m-0" v-model="isChecked" @change="toggleField">
    </div>
</template>

<script>
    export default {
        name: "EditableCheckboxComponent",
        props: ['value', 'id', 'model_name', 'field_name'],
        data: function () {
            return {
                'isChecked': this.value,
                'loading': false
            }
        },
        methods: {
            toggleField: function () {
                this.loading = true;
                console.log(this.id);
            }
        }
    }
</script>

<style scoped>
    .form-check-input {
        cursor: pointer;
    }
</style>
