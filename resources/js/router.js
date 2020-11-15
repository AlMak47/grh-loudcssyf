import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


// COMPONENTS 
import addEmploye from './components/employe/AddEmployeComponent.vue'
import listEmploye from './components/employe/ListEmployeComponent.vue'

import registreAbsence from './components/registre/RegistreAbsenceComponent.vue'
import registrePointage from './components/registre/RegistrePointageComponent.vue'

import profileUser from './components/settings/ProfileComponent.vue'
import postComponent from './components/settings/PostesComponent.vue'
import departementComponent from './components/settings/DepartementComponent.vue'
import dashboard from './components/dashboard/DashboardComponent.vue'
// 
const router = new VueRouter({
    routes : [
        {
            path : '/',
            redirect : '/dashboard'
        },
        {
            path : '/dashboard',
            component : dashboard
        },
        {
            path : '/employe/add',
            component : addEmploye
        },
        {
            path : '/employe/list',
            component : listEmploye
        },
        {
            path : '/registre/pointage',
            component : registrePointage
        },
        {
            path : '/registre/absences',
            component : registreAbsence
        },
        {
            path : '/setting/profile',
            component : profileUser
        },
        {
            path : '/setting/postes',
            component : postComponent
        },
        {
            path : '/setting/departement',
            component : departementComponent
        }
    ]
})

router.afterEach((to,from) => {
    $(function () {
        if($('.sidenav').sidenav()) {
            $('.sidenav').sidenav('close');
        }
    })
})
export default router