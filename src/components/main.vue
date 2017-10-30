<template>
    <div class="container todo-container">
        <welcome></welcome>
        <alert></alert>
        <addInput></addInput>
        <tabs></tabs>
        <todo-app></todo-app>
    </div>
</template>
<script>
    import welcome from './welcome.vue'
    import alert from './alert.vue'
    import addInput from './addInput.vue'
    import todoApp from './todoApp.vue'
    export default {
        components: {
            welcome: welcome
            , alert: alert
            , addInput: addInput
            , 'todo-app': todoApp
        }
    }
</script>