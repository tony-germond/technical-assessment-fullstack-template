<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
  locations: {
    type: Array,
  },
  authorized :{
    type : Boolean
  }
});

const deleteLocation = (locationId) => {
  if (confirm("Confirm ?")) {
    router.delete(route('locations.delete', { location: locationId }));
  }
};</script>

<template>
  <AppLayout title="Locations Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Location Dashboard
      </h2>
    </template>

    <div class="locations-container">
      <h2>Liste des Locations</h2>

      <div class="table-responsive">
        <table class="locations-table">
          <thead>
          <tr class="flex-wrap">
            <th>Name</th>
            <th>Description</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Featured</th>
            <th>Delete</th>
            <th>Edit</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(location, index) in props.locations" :key="index" class="flex-wrap">
            <td>{{ location.name }}</td>
            <td class="w-2/3">
              <div>{{ location.description }}</div>
            </td>
            <td>
              <div>Lat: {{ location.latitude }}</div>
            </td>
            <td>
              <div>Long: {{ location.longitude }}</div>
            </td>
            <td>
              <input type="checkbox" id="checkbox" v-model="location.is_featured" />
              <label for="checkbox"></label>
            </td>
            <td>
              <button class="bg-red-500 rounded-md" @click="deleteLocation(location.id)">
                Delete
              </button>
            </td>
            <td>
              <button class="bg-blue-500 rounded-md">
                Edit
              </button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>

</style>