<template>
    <div class="content-container">
        <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a href="#!" class="breadcrumb">Employe</a>
                    <a href="#!" class="breadcrumb">Ajouter un employe</a>
                </div>
            </div>
        </nav>


        <!-- ALERT SUCCESS BLOCK -->
        <md-dialog-alert :md-active.sync="alertSuccess"
            md-title="Employe ajoute !"
            md-content="Un employe a ete ajoute avec sucess !"></md-dialog-alert>
        <!-- // -->

        <!-- FORMULAIRE D'AJOUT D'UN EMPLOYE -->

        <div class="row">
            <form class="col s12 m12 offset-l3 l6 card" @submit.prevent="sendAddEmployeRequest()">
                <div class="card-content">
                    <div class="card-title">Nouvel Employe</div>
                    <!-- BLOCK ERROR -->
                    <error-block :errors="errors"></error-block>
                    <!-- // -->
                    
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input v-model="dataForm.nom" id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Nom</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">account_box</i>
                                    <input v-model="dataForm.prenom" id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Prenom</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">phone</i>
                                    <input v-model="dataForm.telephone" id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Telephone</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">perm_identity</i>
                                    <input v-model="dataForm.piece_identite" id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Piece D'identite</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">pregnant_woman</i>
                                    <input v-model="dataForm.filiation" id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Filiation</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">calendar_view_day</i>
                                    <input v-model="dataForm.date_naissance" id="icon_prefix" type="date" class="validate">
                                    <label for="icon_prefix">Date de Naissance</label>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l12">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">more_vert</i>
                                    <input v-model="dataForm.numero_facture" type="text" id="icon_prefix" class="validate">
                                    <label for="icon_prefix">Numero de facture</label>
                                </div>
                                <div class="col s12 m12 l12">
                                    <div class="md-layout-item">
                                        <md-field>
                                            <md-icon class="prefix">work</md-icon>
                                            <label for="icon_prefix">Fonction</label>
                                            <md-select v-model="dataForm.fonction">
                                                <md-option v-for="(f,index) in posteData" :key="index" :value="f.reference">{{f.nom}}</md-option>
                                            </md-select>
                                        </md-field>
                                        
                                    </div>
                                </div>
                                <div class="col s12 m12 l12">
                                    <div class="md-layout-item">
                                        <md-field>
                                            <md-icon class="prefix">domain</md-icon>
                                            <label for="icon_prefix">Departement</label>
                                            <md-select v-model="dataForm.departement">
                                                <md-option v-for="(d,index) in departementData" :key="index" :value="d.reference">{{d.title}}</md-option>
                                            </md-select>
                                        </md-field>
                                        
                                    </div>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">place</i>
                                    <input v-model="dataForm.quartier" type="text" id="icon_prefix" class="validate">
                                    <label for="icon_prefix">Quartier</label>
                                </div>
                                <div class="col s12 m12 l12">
                                    <!-- <i class="material-icons prefix">map</i> -->
                                    <div class="md-layout-item">
                                        <md-field>
                                            <!-- <i class="material-icons prefix">work</i> -->
                                            <md-icon class="prefix">map</md-icon>
                                            <label for="icon_prefix">Commune</label>
                                            <md-select v-model="dataForm.commune">
                                                <md-option v-for="(c,index) in communeData" :key="index" :value="c">{{c}}</md-option>
                                            </md-select>
                                        </md-field>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn blue darken-1 col s12 m12">Envoyez <i class="material-icons right">send</i></button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- // -->
    </div>
</template>
<script>

    export default {
        mounted() {
            this.getData()
        },
        data() {
            return {
                dataForm : {
                    _token : "",
                    nom : '',
                    prenom : '',
                    numero_facture : '',
                    // facture_jointe : '',
                    telephone : '',
                    piece_identite : '',
                    fonction : '',
                    departement : '',
                    quartier : '',
                    commune : '',
                    filiation : '',
                    date_naissance : '',
                    // lettre_motivation : '',
                    // cv : ''
                },
                communeData : ['Dixinn','Matam','Kaloum','Matoto','Ratoma','Autre'],
                posteData : [],
                departementData : [],
                errors : [],
                alertSuccess : false
            }
        },
        methods : {
            // RECUPERATION DES INFOS DE SUR LA FONCTION
            getData : async function () {
                try {
                    let response = await axios.get('/admin/employe/add/get-data')
                    if(response) {
                        this.posteData = response.data.postes
                        this.departementData = response.data.departement
                    }
                }
                catch(error) {
                    alert(error)
                }
            },
            // ENREGISTREMENT D'UN EMPLOYE
            sendAddEmployeRequest : async function () {
                try {
                    this.errors = []
                    
                    this.dataForm._token = this._token

                    axios.post('/admin/employe/add',this.dataForm)
                    .then(response =>  {
                        Object.assign(this.$data,this.$options.data())
                        this.alertSuccess = true
                        this.getData()
                    })
                    .catch(error => {
                        // console.log(error.response.data.errors)
                        var theError = []
                        
                        if(error.response.data.errors) {
                            
                            let errorTab = error.response.data.errors
                            for (var prop in errorTab) {
                                theError.push(errorTab[prop][0])
                            }
                        } else {
                            theError.push(error.response.data)
                        }
                        
                        this.$store.commit('setErrors',theError)
                    })          

                    // let response = await axios.post('/admin/employe/add/',this.dataForm)
                    // if(response && response.data == 'done') {
                    //     Object.assign(this.$data,this.$options.data())
                    //     this.alertSuccess = true
                    //     this.getData()
                    // }
                }
                catch(error) {
                    // if(error.response.data.errors) {
                    //     let errorTab = error.response.data.errors
                    //     for (var prop in errorTab) {
                    //         this.errors.push(errorTab[prop][0])
                    //     }
                    // } else {
                    //     this.errors.push(error.response.data)
                    // }
                    
                    // this.$store.commit('setErrors',this.errors)
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
