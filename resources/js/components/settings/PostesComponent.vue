<template>
    <div class="content-container">
        <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a class="breadcrumb">Parametre</a>
                    <a class="breadcrumb">Postes</a>
                </div>
            </div>
        </nav>

        <md-progress-bar v-if="inProgress" md-mode="indeterminate"></md-progress-bar>

        <!-- ALERT SUCCESS BLOCK -->
        <md-dialog-alert :md-active.sync="alertSuccess"
            md-title="Poste ajoute !"
            md-content="Un poste a ete ajoute avec sucess !"></md-dialog-alert>
        <!-- // -->
        <error-block></error-block>

        <div class="row">
            <div class="col s12 m12 l6">
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Postes</h5></li>
                    <li v-for="(p,index) in posteList" :key="index" class="collection-item avatar">
                        <span class="title">{{ p.nom }}</span>
                        <p>{{ p.description }}</p>
                        <div class="secondary-content">
                            <md-button class="md-icon-button md-fab md-mini blue darken-1">
                                <md-icon>edit</md-icon>
                            </md-button>
                            <md-button class="md-icon-button md-fab md-mini">
                                <md-icon>delete</md-icon>
                            </md-button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col s12 m12 l6">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Ajouter un poste</span>
                                <form @submit.prevent="addPoste()">
                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">work</i>
                                            <input v-model="dataForm.intitule" type="text" id="icon_prefix" class="validate">
                                            <label for="icon_prefix">Intitule du poste</label>
                                        </div>
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">attach_money</i>
                                            <input v-model="dataForm.salaire" type="number" id="icon_prefix" class="validate">
                                            <label for="icon_prefix">Salaire Mensuel</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">short_text</i>
                                            <textarea v-model="dataForm.description" id="textarea1" class="materialize-textarea"></textarea>
                                            <label for="textarea1">Description</label>
                                        </div>
                                        <button type="submit" class="waves-effect waves-light btn blue darken-1 col s12 m12 l3">Envoyez <i class="material-icons right">send</i></button>
                                    </div>
                                </form>
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
        mounted() {
            this.getData()
        },
        data() {
            return {
                inProgress : false,
                dataForm : {
                    _token : "",
                    intitule : "",
                    salaire : 0,
                    description : ""
                },
                errors : [],
                alertSuccess : false,
                posteList : []
            }
        },
        methods : {
            getData : async function ()  {
                try {
                    this.inProgress = true

                    let response = await axios.get('/admin/poste/list')
                    if(response) {
                        this.posteList = response.data.all
                        this.inProgress = false
                    }
                }
                catch(error) {
                    alert(error)
                }
            },
            addPoste : async function () {
                try {
                    this.errors = []
                    this.dataForm._token = this._token

                    let response = await axios.post('/admin/poste/add',this.dataForm)
                    if(response && response.data == 'done') {
                        Object.assign(this.$data,this.$options.data())
                        this.alertSuccess = true
                        this.getData()
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
