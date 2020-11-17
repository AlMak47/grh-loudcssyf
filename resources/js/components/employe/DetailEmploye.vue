<template>
    <div class="content-container">
       <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a class="breadcrumb">Employe</a>
                    <a class="breadcrumb">Details</a>
                </div>
            </div>
        </nav>

        <!-- LOADING -->
        <md-progress-bar v-if="inProgress" md-mode="indeterminate"></md-progress-bar>
        <!-- // -->

        <md-button to="/employe/list" class="md-raised blue darken-1 white-text">
            <md-icon class="white-text">keyboard_backspace</md-icon> Retour
        </md-button>

        <div class="row">
            <div class="col s12 m12 l10">
                <md-card>
                    <md-card-header>
                        <div class="md-title">Infos Profile</div>
                    </md-card-header>
                    <md-card-content>
                        <form @submit.prevent="">
                            <div class="row">
                                <div class="input-field col s12 m12 l3">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input v-model="dataForm.nom" id="icon_prefix" type="text" class="validate">
                                    <!-- <label for="icon_prefix">Nom</label> -->
                                </div>
                                <div class="input-field col s12 m12 l3">
                                    <i class="material-icons prefix">account_box</i>
                                    <input v-model="dataForm.prenom" id="icon_prefix" type="text" class="validate">
                                    <!-- <label for="icon_prefix">Prenom</label> -->
                                </div>
                                <div class="input-field col s12 m12 l3">
                                    <i class="material-icons prefix">phone</i>
                                    <input v-model="dataForm.phone" id="icon_prefix" type="text" class="validate">
                                    <!-- <label for="icon_prefix">Telephone</label> -->
                                </div>
                                <div class="input-field col s12 m12 l3">
                                    <i class="material-icons prefix">perm_identity</i>
                                    <input v-model="dataForm.numero_identite" id="icon_prefix" type="text" class="validate">
                                    <!-- <label for="icon_prefix">Piece D'identite</label> -->
                                </div>
                                <div class="input-field col s12 m12 l4">
                                    <i class="material-icons prefix">pregnant_woman</i>
                                    <input v-model="dataForm.filiation" id="icon_prefix" type="text" class="validate">
                                    <!-- <label for="icon_prefix">Filiation</label> -->
                                </div>
                                <div class="input-field col s12 m12 l4">
                                    <i class="material-icons prefix">calendar_today</i>
                                    <input v-model="dataForm.date_naissance" id="icon_prefix" type="date" class="validate">
                                    <!-- <label for="icon_prefix">Date de Naissance</label> -->
                                </div>
                                <div class="input-field col s12 m12 l4">
                                    <i class="material-icons prefix">more_vert</i>
                                    <input v-model="dataForm.numero_facture" type="text" id="icon_prefix" class="validate">
                                    <!-- <label for="icon_prefix">Numero de facture</label> -->
                                </div>
                                <div class="col s12 m12 l4">
                                    <div class="md-layout-item">
                                        <md-field>
                                            <md-icon class="prefix">work</md-icon>
                                            <!-- <label for="icon_prefix">Fonction</label> -->
                                            <md-select v-model="dataForm.fonction">
                                                <md-option v-for="(f,index) in posteData" :key="index" :value="f.reference">{{f.nom}}</md-option>
                                            </md-select>
                                        </md-field>
                                        
                                    </div>
                                </div>
                                <div class="col s12 m12 l4">
                                    <div class="md-layout-item">
                                        <md-field>
                                            <md-icon class="prefix">domain</md-icon>
                                            <!-- <label for="icon_prefix">Departement</label> -->
                                            <md-select v-model="dataForm.departement">
                                                <md-option v-for="(d,index) in departementData" :key="index" :value="d.reference">{{d.title}}</md-option>
                                            </md-select>
                                        </md-field>
                                        
                                    </div>
                                </div>
                                <div class="col s12 m12 l4">
                                    <!-- <i class="material-icons prefix">map</i> -->
                                    <div class="md-layout-item">
                                        <md-field>
                                            <!-- <i class="material-icons prefix">work</i> -->
                                            <md-icon class="prefix">map</md-icon>
                                            <!-- <label for="icon_prefix">Commune</label> -->
                                            <md-select v-model="dataForm.commune">
                                                <md-option v-for="(c,index) in communeData" :key="index" :value="c">{{c}}</md-option>
                                            </md-select>
                                        </md-field>
                                    </div>
                                </div>
                                <div class="input-field col s12 m12 l4">
                                    <i class="material-icons prefix">place</i>
                                    <input v-model="dataForm.quartier" type="text" id="icon_prefix" class="validate">
                                </div>
                            </div>
                            <md-button class="md-raised blue darken-1 white-text">Editer</md-button>
                        </form>
                    </md-card-content>
                </md-card>
            </div>
            <div class="col s12 m12 l2">
                <md-card style="margin-bottom : 5%">
                    <md-card-header>
                        <h2 class="md-title md-caption">Matricule</h2>
                    </md-card-header>
                    <md-card-content>
                        <span class="md-headline">{{ dataForm.matricule }}</span>
                    </md-card-content>
                </md-card>
                <md-card>
                    <md-card-header>
                        <h2 class="md-title md-caption">Salaire (GNF)</h2>
                    </md-card-header>
                    <md-card-content>
                        <span class="md-headline">{{ dataForm.salaire | numeral }}</span>
                    </md-card-content>
                </md-card>
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
                dataForm : {},
                communeData : ['Dixinn','Matam','Kaloum','Matoto','Ratoma','Autre'],
                posteData : [],
                departementData : [],
            }
        },
        methods : {
            getData : async function () {
                this.inProgress = true
                let response = await axios.get('/admin/employe/edit/'+this.$route.params.id)
                if(response) {
                    this.dataForm = response.data.employe
                    this.dataForm.departement = response.data.departement.reference
                    this.dataForm.fonction = response.data.fonction.reference
                    this.dataForm.salaire = response.data.fonction.salaire
                }

                let dataResponse = await axios.get('/admin/employe/add/get-data')
                if(dataResponse) {
                    this.posteData = dataResponse.data.postes
                    this.departementData = dataResponse.data.departement

                    this.inProgress = false
                }
            }
        },
        computed : {
       
        }
    }
</script>