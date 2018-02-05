<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Data</div>
                    
                    <div class="panel-body">
                        <ul class="alert alert-danger" v-if="errors">
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                        <form class="form-horizontal" v-on:submit.prevent="addMahasiswa()" action="">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nim">NIM:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nim" placeholder="Enter email" name="nim" v-model="addData.nim">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nama">Nama:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" placeholder="Enter Name" name="nama" v-model="addData.nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="tanggal_lahir">Tanggal Lahir:</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" v-model="addData.tanggal_lahir">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="tanggal_lahir">Jenis Kelamin:</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="L" v-model="addData.jenis_kelamin">Laki-Laki 
                                    <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="P" v-model="addData.jenis_kelamin">Perempuan 
                                </div>
                            </div>
                            
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    <router-link to="/" tag="button" class="btn btn-sm btn-danger">Batal</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueRouter from 'vue-router'
    var router = new VueRouter();
    export default {
        data() {
            return {
                addData: {
                    'nim':'',
                    'nama' :'',
                    'tanggal_lahir' :'',
                    'jenis_kelamin' :''
                },
                // submitted : false,
                errors:"",
            }
            
        },
        methods: {
            addMahasiswa(){
                var vm = this;
                // deklarasi data untuk di input
                var dataInput = vm.addData;
                axios.post("/addmahasiswa", dataInput)
                .then(function(response){
                    // clar input
                    // vm.addData = {'nim':'','nama' :'','tanggal_lahir' :'','jenis_kelamin' :''}
                    console.log("Sukses");
                    vm.$router.push({ path : '/'})
                    

                    // alert sukses
                    // vm.submitted = true;


                    vm.errors = '';
                })
                .catch(function(error){
                    console.log(error.response.data.tanggal_lahir);
                    vm.errors = error.response.data;
                })

            }
        }

    }
</script>


