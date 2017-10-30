<template>
    <div class="tabs">
        <ul class="nav nav-tabs">
            <li :class="{active: tab =='todo'}" @click="tab = 'todo'"><a href="#">Todo </a></li>
            <li :class="{active: tab =='done'}" @click="tab = 'done'"><a href="#">Done</a></li>
        </ul>
        <ul class="todo-items-container" v-if="tab =='todo'"> <a href="#" @click.prevent="doneAll">Done All tasks</a>
            <li class="todo-item" v-for="todo in todos" v-if="todo.done == '0'"> {{todo.todo}}
                <div class="icons"> <span class="fa fa-check complete" @click="comoleteTodo(todo.id)"></span> <span class="fa fa-remove delete" @click="deleteTodo(todo.id)"> </span> </div>
            </li>
        </ul>
        <ul class="todo-items-container" v-if="tab =='done'"> <a href="#" @click.prevent="clearTodo">clear Done tasks</a>
            <li class="todo-item" v-for="todo in todos" v-if="todo.done == '1'"> {{todo.todo}}
                <div class="icons"> <span class="fa fa-undo undo text-warning" @click="undoTodo(todo.id)"></span> </div>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                tab: 'todo'
            }
        }, computed: {
            todos() {
                return this.$store.getters.getTodos;
            }
        }, methods: {
            deleteTodo(id) {
                this.$store.dispatch("deleteTodo", id);
            }, comoleteTodo(id) {
                this.$store.dispatch("comoleteTodo", id);
            }, undoTodo(id) {
                this.$store.dispatch("undoTodo", id);
            }, clearTodo() {
                this.$store.dispatch("clearTodo");
            }, doneAll() {
                this.$store.dispatch("doneAll");
            }
        }, created() {
            this.$store.dispatch("getTodos");
        }
    }
</script>