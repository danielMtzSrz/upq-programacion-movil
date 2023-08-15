<template>
    <GenericModal
        :data_modal="data_modal"
        @closeModal="closeModal()" 
        :header="titulo"
    >
        <template #content>
            <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="row col-12 pt-4">
                        <div class="col-sm-12 col-md-4">
                            <InputText
                                label="Nombre (s)"
                                name="name"
                                :errors="form.errors.name"
                                v-model="form.name"
                            />
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <InputText
                                label="Apellido paterno"
                                name="apellido_paterno"
                                :errors="form.errors.apellido_paterno"
                                v-model="form.apellido_paterno"
                            />
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <InputText
                                label="Apellido materno"
                                name="apellido_materno"
                                :errors="form.errors.apellido_materno"
                                v-model="form.apellido_materno"
                            />
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <InputText
                                icon="pi pi-at"
                                label="Correo electrónico"
                                name="email"
                                :errors="form.errors.email"
                                v-model="form.email"
                            />
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <InputNumber
                                label="Teléfono"
                                name="telefono"
                                :errors="form.errors.telefono"
                                v-model="form.telefono"
                                :useGrouping="false"
                            />
                        </div>
                        
                        <div class="col-sm-12 col-md-4">
                            <InputNumber
                                label="Edad"
                                name="edad"
                                :errors="form.errors.edad"
                                v-model="form.edad"
                                :useGrouping="false"
                            />
                        </div>

                        <div class="flex align-items-center mb-4">
                            <Checkbox v-model="form.pertenece_comunidad_indigena" :binary="true" />
                            <label class="ml-2"> Pertenece a comunidad indigena: {{ form.pertenece_comunidad_indigena ? 'Sí' : 'No' }} </label>
                        </div>

                        <div class="col-sm-12" v-if="form.pertenece_comunidad_indigena">
                            <InputText
                                label="Comunidades indigenas que pertenece"
                                name="comunidades_indigenas_pertenecientes"
                                :errors="form.errors.comunidades_indigenas_pertenecientes"
                                v-model="form.comunidades_indigenas_pertenecientes"
                            />
                        </div>

                        <div class="flex align-items-center mb-4">
                            <Checkbox v-model="form.habla_lengua_indigena" :binary="true" />
                            <label class="ml-2">Habla lengua indigena: {{ form.habla_lengua_indigena ? 'Sí' : 'No' }} </label>
                        </div>

                        <div class="col-sm-12" v-if="form.habla_lengua_indigena">
                            <InputText
                                label="Lenguas indigenas quehabla"
                                name="lenguas_indigenas"
                                :errors="form.errors.lenguas_indigenas"
                                v-model="form.lenguas_indigenas"
                            />
                        </div>

                        <div class="flex align-items-center mb-4">
                            <Checkbox v-model="form.tiene_discapacidad" :binary="true" />
                            <label class="ml-2">Tiene discapacidad: {{ form.tiene_discapacidad ? 'Sí' : 'No' }} </label>
                        </div>

                        <div class="col-sm-12" v-if="form.tiene_discapacidad">
                            <InputText
                                label="Discapacidades"
                                name="discapacidades"
                                :errors="form.errors.discapacidades"
                                v-model="form.discapacidades"
                            />
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <Dropdown 
                                label="Genero"
                                :data="generos"
                                textDropdown="nombre"
                                v-model="genero_seleccionado"
                            />
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <Dropdown 
                                label="Estado civil"
                                :data="estados_civiles"
                                textDropdown="nombre"
                                v-model="estado_civil_seleccionado"
                            />
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <Dropdown 
                                label="Estado de nacimiento"
                                :data="estados"
                                textDropdown="nombre"
                                v-model="estado_nacimiento_seleccionado"
                            />
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <Dropdown 
                                label="Nacionalidad"
                                :data="nacionalidad"
                                textDropdown="nombre"
                                v-model="nacionalidad_selecionado"
                            />
                        </div>

                        <div class="col-sm-12">
                            <InputText
                                label="Ocupación"
                                name="ocupacion"
                                :errors="form.errors.ocupacion"
                                v-model="form.ocupacion"
                            />
                        </div>

                        <div class="col-sm-12">
                            <InputText
                                label="Lugar asiste"
                                name="lugar_asiste"
                                :errors="form.errors.lugar_asiste"
                                v-model="form.lugar_asiste"
                            />
                        </div>

                        <div class="col-sm-12">
                            <InputText
                                label="Cargo / Puesto"
                                name="cargo_puesto"
                                :errors="form.errors.cargo_puesto"
                                v-model="form.cargo_puesto"
                            />
                        </div>

                        <div class="mb-4 col-sm-12 col-md-6">
                            <div class="p-inputgroup">
                                <span class="p-inputgroup-addon">
                                    <i class="pi pi-key"></i>
                                </span>
                                <span class="p-float-label">
                                    <Password
                                        v-model="form.password"
                                        name="password"
                                        id="password"
                                        autocomplete="new-password"
                                    >
                                    </Password>
                                    <label>Contraseña</label>
                                </span>
                            </div>
                        </div>
        
                        <div class="mb-4 col-sm-12 col-md-6">
                            <div class="p-inputgroup">
                                <span class="p-inputgroup-addon">
                                    <i class="pi pi-key"></i>
                                </span>
                                <span class="p-float-label">
                                    <Password
                                        v-model="form.password_confirmation"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        autocomplete="current-password"
                                    >
                                    </Password>
                                    <label>Confirmar contraseña</label>
                                </span>
                            </div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <FileUpload
                                dropText="Arrastre aquí la foto del usuario."
                                :imagenActual="imagenActual"
                                v-model="form.profile_photo_path"
                                :errors="form.errors.profile_photo_path"
                            />
                        </div>
                    </div>

                    <pre>{{ form }}</pre>

                    <div class="float-end space-x-2 mt-3">
                        <Button
                            type="button"
                            label="Cancelar"
                            class="p-button-text p-button-raised p-button-rounded p-button-warning"
                            @click="closeModal()"
                        />
                        <Button
                            type="submit"
                            label="Guardar"
                            class="p-button-text p-button-raised p-button-rounded p-button-success"
                            :loading="form.processing"
                        />
                    </div>
                </form>
        </template>
    </GenericModal>
</template>

<script setup>

// Vue
import { ref, watch } from "vue";

// Inertia
import { useForm } from "@inertiajs/inertia-vue3";

// Primevue
import Button from "primevue/button";
import Password from "primevue/password";
import Checkbox from 'primevue/checkbox';

// Layouts
import GenericModal from "@/Components/GenericModal.vue";

// Inputs
import InputText from "@/Components/Forms/InputText.vue";
import Dropdown from "@/Components/Forms/Dropdown.vue";
import InputNumber from "@/Components/Forms/InputNumber.vue";
import FileUpload from "@/Components/Forms/FileUpload.vue";

// Variables
const genero_seleccionado = ref(null),
      estado_civil_seleccionado = ref(null),
      nacionalidad_selecionado = ref(null),
      estado_nacimiento_seleccionado = ref(null)

const imagenActual = ref(null)

const generos = ref([
    { "id": 1, "nombre": "Hombre" },
    { "id": 2, "nombre": "Mujer" },
    { "id": 3, "nombre": "Otro" }
])

const estados_civiles = ref([
    { "id": 1, "nombre": "Soltero/a" },
    { "id": 2, "nombre": "Casado/a" },
    { "id": 3, "nombre": "Viudo/a" },
    { "id": 4, "nombre": "Divorciado/a" },
    { "id": 5, "nombre": "Separado/a" },
    { "id": 6, "nombre": "Conviviente" },
    { "id": 7, "nombre": "Unión civil" }
])

const estados = ref([
    { "id": 1, "nombre": "Aguascalientes" },
    { "id": 2, "nombre": "Baja California" },
    { "id": 3, "nombre": "Baja California Sur" },
    { "id": 4, "nombre": "Campeche" },
    { "id": 5, "nombre": "Coahuila de Zaragoza" },
    { "id": 6, "nombre": "Colima" },
    { "id": 7, "nombre": "Chiapas" },
    { "id": 8, "nombre": "Chihuahua" },
    { "id": 9, "nombre": "Distrito Federal" },
    { "id": 10, "nombre": "Durango" },
    { "id": 11, "nombre": "Guanajuato" },
    { "id": 12, "nombre": "Guerrero" },
    { "id": 13, "nombre": "Hidalgo" },
    { "id": 14, "nombre": "Jalisco" },
    { "id": 15, "nombre": "México" },
    { "id": 16, "nombre": "Michoacán de Ocampo" },
    { "id": 17, "nombre": "Morelos" },
    { "id": 18, "nombre": "Nayarit" },
    { "id": 19, "nombre": "Nuevo León" },
    { "id": 20, "nombre": "Oaxaca" },
    { "id": 21, "nombre": "Puebla" },
    { "id": 22, "nombre": "Querétaro" },
    { "id": 23, "nombre": "Quintana Roo" },
    { "id": 24, "nombre": "San Luis Potosí" },
    { "id": 25, "nombre": "Sinaloa" },
    { "id": 26, "nombre": "Sonora" },
    { "id": 27, "nombre": "Tabasco" },
    { "id": 28, "nombre": "Tamaulipas" },
    { "id": 29, "nombre": "Tlaxcala" },
    { "id": 30, "nombre": "Veracruz de Ignacio de la Llave" },
    { "id": 31, "nombre": "Yucatán" },
    { "id": 32, "nombre": "Zacatecas" }
])

const nacionalidad = ref([
    { "id": 1, "nombre": "Mexicana" },
])

const form = useForm({
    _method: null,
    
    apellido_paterno: '',
    apellido_materno: '',
    name: '',
    edad: null,
    email: null,

    sexo: null,
    estado_civil: null,
    estado_nacimiento: null,
    nacionalidad: null,

    pertenece_comunidad_indigena: null,
    comunidades_indigenas_pertenecientes: null,
    habla_lengua_indigena: null,
    lenguas_indigenas: null,
    tiene_discapacidad: null,
    discapacidades: null,
    ocupacion: null,
    lugar_asiste: null,
    cargo_puesto: null,
    telefono: null,

    password: null,
    profile_photo_path: null,
});

const ruta = ref(null),
      titulo = ref(null);

// Props
const props = defineProps({
    data_modal: {
        type: Object,
        default: null,
    },
});

// Emits
const emits = defineEmits(["closeModal"]);

// Methods
const closeModal = () => {
    emits("closeModal");
    form.reset();
    form.errors = {}
};

const submit = () => {

    if (!props.data_modal.data_registro) {
        form.transform((data) => ({
            ...data,
            sexo : genero_seleccionado.value?.id,
            estado_civil : estado_civil_seleccionado.value?.id,
            estado_nacimiento : estado_nacimiento_seleccionado.value?.id,
            nacionalidad : nacionalidad_selecionado.value?.id,
        })).post(route(ruta.value), {
            onSuccess: () => {
                closeModal();
            },
        });

    } else {
        form.transform((data) => ({
            ...data,
            sexo : genero_seleccionado.value?.id,
            estado_civil : estado_civil_seleccionado.value?.id,
            estado_nacimiento : estado_nacimiento_seleccionado.value?.id,
            nacionalidad : nacionalidad_selecionado.value?.id,
        })).put(route(ruta.value, props.data_modal.data_registro), {
            onSuccess: () => {
                closeModal();
            },
        });
    }
};

// Watchers
watch(() => props.data_modal, async (newVal) => {
    ruta.value = !newVal.data_registro ? 'user.store' : 'user.update'
    titulo.value = !newVal.data_registro ? 'Nuevo usuario' : 'Actualizar usuario'
})

watch(() => props.data_modal.data_registro, (newVal) => {
    form.reset()
    
    console.log(newVal)

    form._method = newVal ? "put" : null

    form.apellido_paterno = newVal?.apellido_paterno ?? null
    form.apellido_materno = newVal?.apellido_materno ?? null
    form.name = newVal?.name ?? null
    form.email = newVal?.email ?? null
    form.edad = newVal?.edad ?? null

    form.sexo = newVal?.sexo ?? null
    form.estado_civil = newVal?.estado_civil ?? null
    form.estado_nacimiento = newVal?.estado_nacimiento ?? null
    form.nacionalidad = newVal?.nacionalidad ?? null

    form.pertenece_comunidad_indigena = newVal?.pertenece_comunidad_indigena ?? null
    form.comunidades_indigenas_pertenecientes = newVal?.comunidades_indigenas_pertenecientes ?? null
    form.habla_lengua_indigena = newVal?.habla_lengua_indigena ?? null
    form.lenguas_indigenas = newVal?.lenguas_indigenas ?? null
    form.tiene_discapacidad = newVal?.tiene_discapacidad ?? null
    form.discapacidades = newVal?.discapacidades ?? null
    form.ocupacion = newVal?.ocupacion ?? null
    form.lugar_asiste = newVal?.lugar_asiste ?? null
    form.cargo_puesto = newVal?.cargo_puesto ?? null
    form.telefono = newVal?.telefono ?? null

    form.profile_photo_path = newVal?.profile_photo_path ?? null
    imagenActual.value = newVal?.profile_photo_path ?? null
    
    genero_seleccionado.value = generos.value.find(el => el.id = newVal?.sexo) 
    estado_civil_seleccionado.value = estados_civiles.value.find(el => el.id = newVal?.estado_civil) 
    nacionalidad_selecionado.value = nacionalidad.value.find(el => el.id = newVal?.estado_nacimiento) 
    estado_nacimiento_seleccionado.value = estados.value.find(el => el.id = newVal?.nacionalidad)
})
</script>
