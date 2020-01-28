<template>
    <div>
        <div id="login" v-if="!token">
                <div class="container" style="margin-top:20px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
            <form @submit.prevent="login">
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" v-model="login_email">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" v-model="login_password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            </form></div>
        </div></div></div></div></div>
        <div id="todos" v-else>
            <div class="container" style="margin-top:20px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo List Example</div>
                    <div class="card-body">
                        <form @submit.prevent="addNewTodo">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="newtodo" :disabled="isAddingNew">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" :disabled="isAddingNew">Ekle</button>
                            <br>
                        </form>
                        <ul class="list-group">
                            <li class="list-group-item" 
                            v-for="todo in todos" 
                            :key="todo.id" 
                            @click="toggle(todo.id)"
                            :class="{'completed':todo.completed_at}">
                                
                                    <span v-if="todo.completed_at">✔</span>
                                    <span v-else>⭕</span>
                                    {{ todo.text }}
                           
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "Remzi",
                newtodo: "",
                todos: [],
                isAddingNew : false,
                login_email: null,
                login_password: null,
                token: null

            };
        },
        methods:{
            login(){
                axios.post("http://homestead.local/api/auth/login", {
                    email: this.login_email,
                    password: this.login_password
                })
                .then(response => {
                    this.token = response.data.access_token;
                    axios.defaults.headers.common['Authorization'] = "Bearer"+this.token;
                    this.fetchTodos();
                })
                .catch(response => console.error(response));
            },
            toggle(id){
                const todoIndex = this.todos.findIndex(item => item.id === id);
                if(todoIndex == -1 ) return false;
                
                //axios.put("http://homestead.local/api/todos/" + id + "/toggle")
                axios.put(`http://homestead.local/api/todos/${id}/toggle`)
                .then(response => {
                    this.todos[todoIndex].completed_at = response.data.completed_at;
                })
                .catch(response => {
                    console.error(response);
                });
            },
            fetchTodos(){
               axios.get("http://homestead.local/api/todos")
                .then(response => {
                    this.todos = response.data;
                })
                .catch(response => {
                    console.error(response);
                });
            },
            addNewTodo(){
                if(this.newtodo.length<3) return false;
                this.isAddingNew= true;
                axios.post("http://homestead.local/api/todos",{
                    todo:this.newtodo
                })
                .then(response => {
                    this.todos.unshift(response.data);
                    this.newtodo = "";
                })
                .catch(response => {
                    console.error(response);
                })
                .then(()=>{
                    this.isAddingNew = false;
                });
            }
        },

    }
</script>

<style>
    .completed{
        text-decoration: line-through;
    }
</style>