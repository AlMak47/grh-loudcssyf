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

        <!-- LISTING DES EMPLOYES -->
        <div class="row">
            <!-- <div class="col s12 m12 l3">
                <nav class="search">
                    <div class="nav-wrapper">
                        <form>
                            <div class="input-field">
                                <input id="search" type="search" placeholder="Recherche rapide ">
                                <label class="label-icon" for="search"><i class="material-icons" style="color: #000">search</i></label>
                                <i class="material-icons">close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </div> -->
            <div class="col s12 m12 l12">
                <md-table v-model="employes" md-sort="name" md-sort-order="asc" md-card>
                    <md-table-toolbar>
                        Tous les Employe(s)
                    </md-table-toolbar>

                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                        <md-table-cell v-for="(col,index) in item" :key="index" :md-label="index.toUpperCase()" :md-sort-by="index">{{ col }}</md-table-cell>
                        <md-table-cell md-label="-">
                            <md-button class="md-icon-button md-fab md-mini blue darken-1">
                                <md-icon class="white-text">edit</md-icon>
                                <md-tooltip md-direction="top">Editer</md-tooltip>
                            </md-button>
                            <md-button class="md-icon-button md-fab md-mini grey darken-1">
                                <md-icon class="white-text">preview</md-icon>
                                <md-tooltip md-direction="top">Details</md-tooltip>
                            </md-button>
                        </md-table-cell>
                    </md-table-row>
                </md-table>                

                <!-- <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th v-for="(h,index) in tableHeader" :key="index"><i class="material-icons left">{{h.icon}}</i>{{h.name}}</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in 10" :key="i">
                            <td>XXYYEEDDSSKD</td>
                            <td>john</td>
                            <td>john</td>
                            <td>666000000</td>
                            <td>john</td>
                            <td>john</td>
                            <td>john</td>
                            <td>john</td>
                            <td>
                                <button type="submit" class="waves-effect btn-small waves-light btn-floating blue darken-1"><i class="material-icons right">edit</i></button>
                                <button type="submit" class="waves-effect btn-small waves-light btn-floating grey darken-1"><i class="material-icons right">more_horiz</i></button>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
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

                tableHeader  : [
                    {
                        name : 'Matricule',
                        icon : 'info'
                    },
                    {
                        name : 'Nom',
                        icon : 'account_circle'
                    },
                    {
                        name : 'Prenom',
                        icon : 'account_box'
                    },
                    {
                        name : 'Telephone',
                        icon : 'phone'
                    },
                    {
                        name : 'Fonction',
                        icon : 'work'
                    },
                    {
                        name : 'Departement',
                        icon : 'domain'
                    },
                    {
                        name : 'Piece identite',
                        icon : 'perm_identity'
                    },
                    {
                        name : 'Quartier',
                        icon : 'place'
                    },
                    {
                        name : 'Commune',
                        icon : 'map'
                    }
                ],

                employes : []
            }
        },
        methods : {
            getData : async function () {
                try {
                    let response = await axios.get('/admin/employe/list')
                    if(response) {
                        this.employes = response.data.all
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
