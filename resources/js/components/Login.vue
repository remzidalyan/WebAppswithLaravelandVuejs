<template>
    <div id="login">
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
                            </form>
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
                login_email: null,
                login_password: null,
            };
        },
        methods: {
            login(){
                axios.post("http://homestead.local/api/auth/login", {
                    email: this.login_email,
                    password: this.login_password
                })
                .then(response => {
                   //this.$emit('token-received',response.data.access_token);
                   this.$store.commit("setToken",response.data.access_token);
                })
                .catch(response => console.error(response));
            },
        }
}
</script>