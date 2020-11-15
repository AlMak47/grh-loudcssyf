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

        <div class="">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#test1">Infos profile</a></li>
                    <li class="tab col s3"><a href="#test2">Changez le mot de passe</a></li>
                </ul>
            </div>
            <div id="test1" class="col s12">
                <!-- INFOS PROFILE -->
                <div class="row">

                    <div class="col s12 m12 l6">
                        <ul class="collection">
                            <li class="collection-item avatar" v-for="(p,index) in tableHeader" :key="index">
                                <i class="material-icons circle">{{p.icon}}</i>
                                <span class="title">{{p.name}}</span>
                                <p>lorem</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // -->
            </div>
            <div id="test2" class="col s12">
                <!-- CHANGEMENT DE MOT DE PASSE UTILISATEUR -->
                <form @submit.prevent="">
                    <div class="row">
                        <div class="col s12 m12 l6">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">lock_open</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Ancien Mot de passe</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Nouveau Mot de passe</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Confirmez le Mot de passe</label>
                                </div>
                            </div>
                            <button type="submit" class="waves-effect waves-light btn blue darken-2 col s12 m12 l2">Envoyez <i class="material-icons right">send</i></button>
                        </div>
                    </div>
                </form>
                <!-- // -->
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
            }
        }
    }
</script>
