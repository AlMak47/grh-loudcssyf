<template>
    <div class="">
        <div class="container">
            <div class="row">
                
                <div class="col s12 m12 l6 offset-l3 login-card">
                    <div class="card grey lighten-4">
                        <div class="card-content">
                            <h5 class="">Authentification</h5>
                            <form @submit.prevent="logIn()">
                                <div class="row">
                                    <div v-if="errors" class="">
                                        <div v-for="(error,index) in errors" :key="index" class="red-text lighten-1 center">
                                            <p>
                                                {{error}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input v-model="dataForm.username" id="icon_prefix" type="text" class="validate">
                                        <label for="icon_prefix">Nom d'utilisateur</label>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <i class="material-icons prefix">lock</i>
                                        <input v-model="dataForm.password" id="icon_prefix" type="password" class="validate">
                                        <label for="icon_prefix">Mot de passe</label>
                                    </div>
                                    <button type="submit" class="waves-effect waves-light btn blue darken-4 col s12 m12 l12">LogIn <i class="material-icons right">send</i></button>
                                </div>
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
        mounted() {},
        data() {
            return {
                dataForm : {
                    _token : "",
                    username : "",
                    password : ""
                },
                errors : []
            }
        },
        methods : {
            logIn : async function () {
                this.errors = []
                try {
                    this.dataForm._token = this._token
                    let response = await axios.post('/login',this.dataForm)
                    if(response && response.data =='done') {
                        alert('success !')
                        window.location.href= "/app"
                    }
                }
                catch(error) {
                    if(error.response.data.errors) {
                        let errorTab = error.response.data.errors
                        for (var prop in errorTab) {
                            this.errors.push(errorTab[prop][0])
                        }
                    } else {
                        this.errors.push(error.response.data)
                    }
                }
            }
        },
        computed : {
            _token() {
                return this.$store.state._token
            }
        }
    }
</script>
