<template>
    <div>
        <login-page v-if="!token"></login-page>
        <todolist-page v-else></todolist-page>
    </div>
</template>

<script>
    import LoginPage from "./components/Login.vue";
    import TodoListPage from "./components/TodoList.vue";

    export default {
        components: {
            "login-page": LoginPage,
            "todolist-page": TodoListPage
        },
        computed: {
            token() {
                return this.$store.state.token;
            }
        }
    }
</script>