<template>
    <div>
         <md-toolbar class="md-accent blue darkeb-1" md-elevation="1">
            <h3 class="md-title" style="flex: 1">Ressources Humaines</h3>

            
            <md-menu v-for="(m,index) in menu" :key="index" md-size="big">
                <md-button class="md-button-icon" md-menu-trigger><md-icon>{{m.icon}}</md-icon> {{ m.name }}</md-button>
                <md-menu-content>
                    <md-button :to="i.link" class="md-button-icon" v-for="(i,ind) in m.items" :key="ind"><md-icon>{{i.icon}}</md-icon>{{ i .name}}</md-button>
                </md-menu-content>
            </md-menu>
        </md-toolbar>
        <!-- <md-toolbar class="md-dense blue darken-1">
            <h1 class="white-text md-title">Ressources Humaines</h1>

            <md-menu md-size="auto">
                <md-button md-menu-trigger>Auto</md-button>
                <md-menu-content>
                    <md-menu-item>My Item 1</md-menu-item>
                    <md-menu-item>This content is long enough</md-menu-item>
                    <md-menu-item>My Item 3</md-menu-item>
                </md-menu-content>
            </md-menu>
        </md-toolbar> -->
        <!-- <nav class="blue darken-1">
            <div class="nav-wrapper">
                <md-button class="md-icon-button sidenav-trigger" data-target="slide-out">
                    <md-icon class="white-text">menu</md-icon>
                </md-button>
                <a href="#!" class="md-title white-text">GRH</a>
                <ul class="right">
                    <li>
                        <md-button @click="logOut()" class="">
                            <md-icon class="white-text">power_settings_new</md-icon>
                        </md-button>
                    </li>
                </ul>
            </div>
        </nav>

        <md-list id="slide-out" class="sidenav" :md-expand-single="expandSingle">
            <md-list-item v-for="(m,index) in menu" :key="index" md-expand>
                <md-icon>{{m.icon}}</md-icon>
                <span class="md-list-item-text">{{m.name}}</span>

                <md-list slot="md-expand">
                    <md-list-item v-for="(i,ind) in m.items" :key="ind" class="md-inset">
                        <md-button :to="i.link">{{i.name}}</md-button>
                    </md-list-item>
                </md-list>
            </md-list-item>
        </md-list> -->
        
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
                            {
                                name : 'Profile',
                                link : '/setting/profile',
                                icon : 'account_box'
                            },
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
                            {
                                name : 'Deconnexion',
                                link : '',
                                icon : 'power_settings_new'
                            }
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
