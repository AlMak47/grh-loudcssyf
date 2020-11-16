<template>
    <div class="content-container">
        <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a class="breadcrumb">Parametre</a>
                    <a class="breadcrumb">Profile</a>
                </div>
            </div>
        </nav>

        <md-progress-bar v-if="inProgress" md-mode="indeterminate"></md-progress-bar>
        <error-block></error-block>

        <!-- ALERT SUCCESS BLOCK -->
        <md-dialog-alert :md-active.sync="alertSuccess"
            md-title="Modification de mot de passe utilisateur !"
            md-content="Vous avez changer votre mot de passe avec success !"></md-dialog-alert>
        <!-- // -->

        <div class="row">
            <div class="col s12 m12 l6">
                <md-card>
                    <md-card-header>
                        <div class="md-title">Infos Utilisateur</div>
                    </md-card-header>
                    <md-card-content>

                    </md-card-content>
                </md-card>
            </div>
            <div class="col s12 m12 l6">
                <md-card>
                    <md-card-header>
                        <div class="md-title">Changez le mot de passe utilisateur</div>
                    </md-card-header>
                    <md-card-content>
                        <form @submit.prevent="changePassword()">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">lock_open</i>
                                            <input v-model="dataForm.old_password" id="icon_prefix" type="password" class="validate">
                                            <label for="icon_prefix">Ancien Mot de passe</label>
                                        </div>
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">lock</i>
                                            <input v-model="dataForm.password" id="icon_prefix" type="password" class="validate">
                                            <label for="icon_prefix">Nouveau Mot de passe</label>
                                        </div>
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">lock</i>
                                            <input v-model="dataForm.password_confirmation" id="icon_prefix" type="password" class="validate">
                                            <label for="icon_prefix">Confirmez le Mot de passe</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="waves-effect waves-light btn blue darken-2 col s12 m12 l3">Envoyez <i class="material-icons right">send</i></button>
                                </div>
                            </div>
                        </form>
                    </md-card-content>
                </md-card>
            </div>
        </div>
       
    </div>
</template>

<script>
    export default {
        mounted() {
            $(function () {

                $('.tabs').tabs();
            })
        },
        data() {
            return {
                inProgress : false,
                dataForm : {
                    _token : "",
                    old_password : "",
                    password : "",
                    password_confirmation : ""
                },
                errors : [],
                alertSuccess : false
            }
        },
        methods : {
            changePassword : async function () {
                try {
                    this.inProgress = true
                    this.errors = []
                    this.dataForm._token = this._token
                    let response = await axios.post('/setting/profile/change-password',this.dataForm)
                    if(response && response.data == 'done') {
                        Object.assign(this.$data,this.$options.data())
                        this.alertSuccess = true
                        // this.getData()
                        this.inProgress = false
                    }
                }
                catch(error) {
                    this.inProgress = false

                    if(error.response.data.errors) {
                        let errorTab = error.response.data.errors
                        for (var prop in errorTab) {
                            this.errors.push(errorTab[prop][0])
                        }
                    } else {
                        this.errors.push(error.response.data)
                    }

                    this.$store.commit('setErrors',this.errors)
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
