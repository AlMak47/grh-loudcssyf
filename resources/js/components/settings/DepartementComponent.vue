<template>
    <div class="content-container">
        <nav class="clean">
            <div class="nav-wrapper">
                <div class="col s12">
                    <router-link to="/dashboard" class="breadcrumb"><i class="material-icons">dashboard</i></router-link>
                    <a class="breadcrumb">Parametre</a>
                    <a class="breadcrumb">Departement</a>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col s12 m12 l6">
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Departement</h5></li>
                    <li v-for="i in 10" :key="i" class="collection-item avatar">
                        <span class="title">Laye Distribution</span>
                        <p>Description</p>
                        <a class="secondary-content btn btn-small btn-floating blue darken-1"><i class="material-icons">edit</i></a>

                        <!-- <div>Alvin
                            <span href="#!" class="secondary-content">
                                <a class="btn btn-small btn-floating blue darken-1"><i class="material-icons">edit</i></a>
                            </span>
                        </div> -->
                    </li>
                </ul>
            </div>
            <div class="col s12 m12 l6">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Ajouter un departement</span>
                                <form @submit.prevent="">
                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">work</i>
                                            <input type="text" id="icon_prefix" class="validate">
                                            <label for="icon_prefix">Intitule</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">short_text</i>
                                            <textarea id="textarea1" class="materialize-textarea"></textarea>
                                            <label for="textarea1">Textarea</label>
                                        </div>
                                        <button type="submit" class="waves-effect waves-light btn blue darken-1 col s12 m12 l3">Envoyez <i class="material-icons right">send</i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
    export default {
        mounted() {},
        data() {
            return {

            }
        },
        methods : {
            addDepartement : async function () {
                try {
                    let response = await axios.post('')
                    if(response) {
                        console.log(response.data)
                    }
                }
                catch(error) {
                    alert(error)
                }
            }
        }
    }
</script>
