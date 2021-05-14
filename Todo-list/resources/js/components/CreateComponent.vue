<template>

  <div class="bg-white shadow p-2">
    <h4 class="pt-1 m-0"><i class="fas fa-plus"></i> Ekle</h4>
    <div class="form-group bg-light m-1 p-2 shadow rounded">
      <label>Başlık</label>
      <input type="text" v-on:keyup="titleCheck" v-model="title" class="form-control" placeholder="Başlık">
      <small class="text-danger" v-if="!title_check"><b>En az 6 karakter girilmelidir. <i class="fas fa-times"></i></b></small>
      <small class="text-success" v-if="title_check"><b>Uygun. <i class="fas fa-check"></i></b></small>
    </div>
    <div class="form-group bg-light m-1 p-2 shadow rounded">
      <label>Tarih</label>
      <input type="date" v-bind:min="date" v-model="date" class="form-control">
    </div>
    <div class="form-group bg-light m-1 p-2 shadow rounded row">
      <div class="col-6">
        <label>Saat</label>
        <select class="form-control" v-model="hour_select" v-on:change="hourChange">
          <option v-for="(ho,key) in hour">{{ho}}</option>
        </select>
        <small class="text-danger" v-if="!hour_check"><b>Saat Seçin. <i class="fas fa-times"></i></b></small>
        <small class="text-success" v-if="hour_check"><b>Uygun. <i class="fas fa-check"></i></b></small>
      </div>
      <div class="col-6">
        <label>Dakika</label>
        <select class="form-control" v-model="min_select" v-on:change="minChange">
          <option v-for="min in minute">{{min}}</option>
        </select>
        <small class="text-danger" v-if="!min_check"><b>Dakika Seçin. <i class="fas fa-times"></i></b></small>
        <small class="text-success" v-if="min_check"><b>Uygun. <i class="fas fa-check"></i></b></small>
      </div>
    </div>
    <div class="form-group bg-light m-1 p-2 shadow rounded">
      <label>Hakkında</label>
      <textarea class="form-control" v-model="content" v-on:keyup="contentCheck" style="resize:none;" rows="8"></textarea>
      <small class="text-danger" v-if="!content_check"><b>En az 12 karakter girilmelidir. <i class="fas fa-times"></i></b></small>
      <small class="text-success" v-if="content_check"><b>Uygun. <i class="fas fa-check"></i></b></small>
    </div>
    <div class="form-group bg-light m-1 p-2 shadow rounded">
      <button class="btn btn-success" v-on:click="submitForm">Kaydet</button>
      <button class="btn btn-primary" v-on:click="clearForm">Temizle</button>
    </div>
  </div>

</template>

<script>
  export default{
    props: ['getContent'],
    mounted(){
      //Bugün için saat ve dakikada geçmiş dakika ve saatler gözükmesin.
      //SAAT
      var hour = new Date().toISOString().slice(11,13)
      for (var i = hour; i < 24; i++) {
        this.hour.push(i);
      }
      //DAKİKA
      var minute = new Date().toISOString().slice(14,16)
      for (var i = minute; i < 60; i++) {
        this.minute.push(i);
      }

    },
    data(){
      return{
        //BAŞLIK
        title:null,
        title_check:false,
        //TARİH
        date:new Date().toISOString().slice(0,10),
        //SAAT-DAKİKA
        hour_select:null,
        hour:[],
        hour_check:false,
        min_select:null,
        minute:[],
        min_check:false,
        //AÇIKLAMA
        content:null,
        content_check:false
      }
    },
    methods:{
      submitForm:function(){
        this.$emit('submit-form')
        if(this.title_check && this.content_check && this.hour_check && this.min_check){
          axios.post('http://localhost:8000/api/create',{
            title:this.title,
            date:this.date,
            hour:this.hour_select,
            minute:this.min_select,
            content:this.content
          }).then((response)=>{
            console.log(response)
          })
        }
      },
      titleCheck:function(){//BAŞLIK DEĞER KONTROL
        if(this.title.length >= 6){
          this.title_check = true;
        }else{
          this.title_check = false;
        }
      },
      contentCheck:function(){//AÇIKLAMA DEĞER KONTROL
        if(this.content.length >= 12){
          this.content_check = true;
        }else{
          this.content_check = false;
        }
      },
      hourChange:function(){
        if(this.hour_select != null){
          this.hour_check = true;
        }
        //Saat değişince dakikalar ayarlansın.
        if(this.hour_select == new Date().toISOString().slice(11,13)){
          var minute = new Date().toISOString().slice(14,16)
          this.minute = []
          for (var i = minute; i < 60; i++) {
            if(i < 10){
              this.minute.push("0"+i);
            }else{
              this.minute.push(i);
            }
          }
        }else{
          this.minute = []
          for (var i = 0; i < 60; i++) {
            if(i < 10){
              this.minute.push("0"+i);
            }else{
              this.minute.push(i);
            }
          }
        }
      },
      minChange:function(){
        if(this.min_select != null){
          this.min_check = true;
        }
      },
      clearForm:function(){//FORM TEMİZLE
        this.title=null;
        this.title_check=false;
        this.content=null;
        this.content_check=false;
      }

    }
  }
</script>
