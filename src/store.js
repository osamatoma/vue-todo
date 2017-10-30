import Vue from 'vue'
import VueResource from 'vue-resource'
import Vuex from 'vuex'
Vue.use(VueResource);
Vue.use(Vuex);
let V = new Vue();
export const store = new Vuex.Store({
    state: {
        response: ''
        , todos: []
    }
    , getters: {
        getTodos(state) {
            return state.todos;
        }, response(state) {
            return state.response;
        }
    }
    , mutations: {
        setTodos(state, todos) {
            state.todos = todos
        }, setResponse(state, response) {
            state.response = response;
        }
    }
    , actions: {
        getTodos(context) {
            V.$http.get('data.php?getTodos').then(res => {
                context.commit('setTodos', res.body);
            });
        }, addTodo(context, value) {
            let data = new FormData();
            data.append('todo', value);
            V.$http.post('data.php', data).then(res => {
                console.log(res);
                context.commit('setResponse', res.body.response);
                context.commit('setTodos', res.body.todos);
                console.log(res.body);
            });
        }, deleteTodo(context, id) {
            let data = new FormData();
            data.append('deleteId', id);
            V.$http.post('data.php', data).then(res => {
                context.commit('setResponse', res.body.response);
                context.commit('setTodos', res.body.todos);
            });
        }, comoleteTodo(context, id) {
            let data = new FormData();
            data.append('completeId', id);
            V.$http.post('data.php', data).then(res => {
                context.commit('setResponse', res.body.response);
                context.commit('setTodos', res.body.todos);
            });
        }, undoTodo(context, id) {
            let data = new FormData();
            data.append('undoId', id);
            V.$http.post('data.php', data).then(res => {
                context.commit('setResponse', res.body.response);
                context.commit('setTodos', res.body.todos);
            });
        }, clearTodo(context) {
            let data = new FormData();
            data.append('clearAllDone', true);
            V.$http.post('data.php', data).then(res => {
                context.commit('setResponse', res.body.response);
                context.commit('setTodos', res.body.todos);
            });
        }, doneAll(context) {
            let data = new FormData();
            data.append('doneAll', true);
            V.$http.post('data.php', data).then(res => {
                context.commit('setResponse', res.body.response);
                context.commit('setTodos', res.body.todos);
            });
        }
    }
})