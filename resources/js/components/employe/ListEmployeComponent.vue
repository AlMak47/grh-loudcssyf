<template>
    <div class="content-container">
        <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a class="breadcrumb">Employe</a>
                    <a class="breadcrumb">Liste des employes</a>
                </div>
            </div>
        </nav>

        <!-- LOADING -->
        <md-progress-bar v-if="inProgress" md-mode="indeterminate"></md-progress-bar>
        <!-- // -->

        <md-button to="/employe/add" class="md-raised blue darken-1 white-text">
            Nouvel Employe
        </md-button>

        <!-- LISTING DES EMPLOYES -->
        <div class="row">
            <div class="col s12 m12 l12">
                <md-table v-model="employes" md-sort="name" md-sort-order="asc" md-card>
                    <md-table-toolbar>
                        Tous les Employe(s)
                    </md-table-toolbar>

                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                        <md-table-cell v-for="(col,index) in item" :key="index" :md-label="index.toUpperCase()" :md-sort-by="index">{{ col }}</md-table-cell>
                        <md-table-cell  md-label="-">
                            <md-button :to="'/employe/edit/'+encryptedData[item.matricule]" class="md-icon-button md-fab md-mini blue darken-1">
                                <md-icon class="white-text">edit</md-icon>
                                <md-tooltip md-direction="top">Editer</md-tooltip>
                            </md-button>
                            <md-button class="md-icon-button md-fab md-mini">
                                <md-icon class="white-text">delete</md-icon>
                                <md-tooltip md-direction="top">Licencier</md-tooltip>
                            </md-button>
                        </md-table-cell>
                    </md-table-row>
                </md-table>
            </div>
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
                inProgress : false,
                employes : [],
                encryptedData : []
            }
        },
        methods : {
            getData : async function () {
                try {
                    this.inProgress = true
                    let response = await axios.get('/admin/employe/list')
                    if(response) {
                        this.employes = response.data.all
                        this.encryptedData = response.data.encrypted
                        this.inProgress = false
                    }
                }
                catch(error) {
                    alert(error)
                }
            }
        },
        computed : {

        }
    }
</script>
