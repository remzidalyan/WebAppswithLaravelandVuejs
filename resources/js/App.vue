<template>
    <login-page v-if="!token" @token-received="setToken"></login-page>
    <todolist-page v-else></todolist-page>
</template>

<script>
    import LoginPage from "./components/Login.vue";
    import TodoListPage from "./components/TodoList.vue";
    export default {
        components: {
            "login-page": LoginPage,
            "todolist-page": TodoListPage
        },
        data() {
            return {
                token: null
            };
        },
        methods: {
            setToken(token) {
                this.token = token;
                axios.defaults.headers.common['Authorization'] = "Bearer" + this.token;
            },
        },
    }
</script>