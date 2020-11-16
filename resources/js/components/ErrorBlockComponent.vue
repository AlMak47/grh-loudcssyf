<template>
    <div>
        <!-- BLOCK ERROR -->
        <md-dialog :md-active="errors.length > 0">
            <md-dialog-title>Erreur(s)</md-dialog-title>
            <md-dialog-content>
                <div v-for="(err,index) in errors" :key="index" class="card white-text center red lighten-2">
                    {{
                        err
                    }}
                </div>
            </md-dialog-content>
            <md-dialog-actions>
                <md-button class="md-primary" @click="hideErrorLog()">Fermer</md-button>
            </md-dialog-actions>
        </md-dialog>
        <!-- // -->
    </div>
</template>

<script>
    export default {
        props : {},
        mounted() {},
        methods : {
            // MASQUEZ LES ERREURS
            hideErrorLog : function () {
                this.$store.commit('setErrors',[])
            }
        },
        computed : {
            errors() {
                return this.$store.state.errors
            }
        }
    }
</script>
