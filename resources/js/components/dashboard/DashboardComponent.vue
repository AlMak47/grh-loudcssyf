<template>
    <div class="content-container">
        <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a class="breadcrumb">Tableau de bord</a>
                </div>
            </div>
        </nav>

        <div class="row">
            <div v-for="(d,index) in dataDashboard" :key="index" class="col s12 m12 l3">
                <div  :class="'card white-text '+d.color">
                    <div class="card-content">
                        <span class="card-title">{{d.name}}</span>
                        <h1 class="center">{{d.stat}}</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        mounted() {

            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        },
        data() {
            return {
               dataDashboard  : [
                   {
                       name : 'Employe(s)',
                       stat : 6,
                       color : 'blue darken-1'
                   },
                   {
                       name : 'Poste(s)',
                       stat : 6,
                       color : 'teal darken-1'
                   },
                   {
                       name : 'Present(s)',
                       stat : 6,
                       color : 'grey darken-1'
                   },
                   {
                       name : 'Absents(s)',
                       stat : 6,
                       color : 'blue-grey darken-1'
                   },
               ]
            }
        },
        methods : {
           
        },
        computed : {
            userName() {
                return this.$store.state.userName
            }
        }
    }
</script>
