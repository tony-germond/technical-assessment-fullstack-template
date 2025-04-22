<script setup>
import { onMounted, ref } from 'vue';
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  locations: {
    type: Array,
  }
});

const form = useForm({
  name :'',
  description :'',
  category:'',
  latitude:'',
  longitude:''
})

const categories = [
  { id: 'Rivière', name: 'Rivière' },
  { id: 'Ruisseau', name: 'Ruisseau' },
  { id: 'Fleuve', name: 'Fleuve' },
];


onMounted(() => {
  var map = L.map('map').setView([43.609169, 1.381720], 2);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  props.locations.forEach((value,index) => {
    var marker = L.marker([value.latitude,value.longitude]).addTo(map)
    marker.bindPopup("<b>Name :"+value.name+"</b></br></b> Description:"+value.description+"</b>")
  })
  function onMapClick(e) {
    form.latitude = e.latlng.lat
    form.longitude = e.latlng.lng
  }
  map.on('click', onMapClick)
});

const createLocation = () => {
  form.post(route('locations.store'), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<style scoped>
#map {
  width: 100%;
  height: 400px;
  border-radius: 0.5rem;
}
</style>

<template>
  <AppLayout title="Locations">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Location
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div id="map"></div>
        </div>
      </div>
    </div>


    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <h1> Add location </h1>
            <form @submit.prevent="createLocation">
              <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" v-model="form.name" type="text" required />
                <InputError :message="form.errors.name" class="mt-2" />
              </div>
              <div>
                <InputLabel for="description" value="Description" />
                <TextInput id="description" v-model="form.description" type="text" required />
                <InputError :message="form.errors.description" class="mt-2" />
              </div>
              <div>
                <select
                    id="category"
                    v-model="form.category"
                    required
                >
                  <option value="" disabled>Select a category</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
                <InputError :message="form.errors.category" class="mt-2" />
              </div>

              <div>
                <InputLabel for="latitude" value="Latitude" />
                <TextInput
                    id="latitude"
                    v-model="form.latitude"
                    type="number"
                    required
                />
                <InputError :message="form.errors.latitude" class="mt-2" />
              </div>

              <div>
                <InputLabel for="longitude" value="Longitude" />
                <TextInput
                    id="longitude"
                    v-model="form.longitude"
                    type="number"
                    required
                />
                <InputError :message="form.errors.longitude" class="mt-2" />
              </div>
              <PrimaryButton>Save</PrimaryButton>
            </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

