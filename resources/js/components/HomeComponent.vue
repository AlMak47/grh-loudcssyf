<template>
    <div>
        <md-toolbar class="md-accent blue darkeb-1" md-elevation="1">
            <h3 class="md-title" style="flex: 1">Ressources Humaines</h3>


            <md-menu md-size="auto">
                <md-button to="/dashboard" class="md-button-icon"><md-icon>dashboard</md-icon> Tableau de bord</md-button>
            </md-menu>

            
            <md-menu v-for="(m,index) in menu" :key="index" md-size="auto">
                <md-button class="md-button-icon" md-menu-trigger><md-icon>{{m.icon}}</md-icon> {{ m.name }}</md-button>
                <md-menu-content>
                    <md-button :to="i.link" class="md-button-icon" v-for="(i,ind) in m.items" :key="ind"><md-icon>{{i.icon}}</md-icon>{{ i .name}}</md-button>
                </md-menu-content>
            </md-menu>

            <md-menu md-size="auto">
                <md-button class="md-button-icon" md-menu-trigger><md-icon>account_circle</md-icon>{{ userName }}</md-button>
                <md-menu-content>
                    <md-button class="md-button-icon" to="/setting/profile"><md-icon>account_box</md-icon> Profile</md-button>
                    <md-button @click="logOut()" class="md-button-icon"><md-icon>power_settings_new</md-icon> Deconnexion</md-button>
                </md-menu-content>
            </md-menu>
            
        </md-toolbar>
    </div>
</template>
<script>
    export default {
        mounted() {
            $(function () {
                $('.sidenav').sidenav();
            })
        },
        data() {
            return {
                errors : [],
                expandSingle: false,
                menu : [
                    {
                        name : 'Employe',
                        icon : 'supervisor_account',
                        items : [
                            {
                                name : 'Ajouter',
                                link : '/employe/add',
                                icon : 'add_box'
                            },
                            {
                                name : 'Listing',
                                link : '/employe/list',
                                icon : 'list'
                            }
                        ]
                    },
                    {
                        name : 'Registre',
                        icon : 'assignment',
                        items : [
                            {
                                name : 'Pointages',
                                link : '/registre/pointage',
                                icon : 'done'
                            },
                            {
                                name : 'Absences',
                                link : '/registre/absences',
                                icon : 'clear'
                            }
                        ]
                    },
                    {
                        name : 'Parametres',
                        icon : 'settings',
                        items : [
                            // {
                            //     name : 'Profile',
                            //     link : '/setting/profile',
                            //     icon : 'account_box'
                            // },
                            {
                                name : "Postes",
                                link : '/setting/postes',
                                icon : 'work'
                            },
                            {
                                name : "Departement",
                                link : '/setting/departement',
                                icon : 'domain'
                            },
                            // {
                            //     name : 'Deconnexion',
                            //     link : '',
                            //     icon : 'power_settings_new'
                            // }
                        ]
                    }
                ]
            }
        },
        methods : {
            logOut : async function () {
                try {
                    let response = await axios.post('/logout')
                    if(response){
                        location.reload()
                    }
                }
                catch(error) {
                    alert(error)
                }
            }
        },
        computed : {
            userName() {
                return this.$store.state.userName
            }
        }
    }
</script>
