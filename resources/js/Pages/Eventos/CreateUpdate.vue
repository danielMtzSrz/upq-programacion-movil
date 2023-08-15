<template>
    <GenericModal
        :data_modal="data_modal"
        @closeModal="closeModal()" 
        :header="titulo"
    >
        <template #content>
            <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="row col-12 pt-4">
                        <div class="col-sm-12 col-md-8">
                            <InputText
                                label="Nombre del evento"
                                name="nombre"
                                :errors="form.errors.nombre"
                                v-model="form.nombre"
                            />
                        </div>

                        <div class="flex align-items-center mb-4 col-sm-12 col-md-4">
                            <Checkbox v-model="form.pertenece_comunidad_indigena" :binary="true" />
                            <label class="ml-2">Estatus: {{ form.pertenece_comunidad_indigena ? 'Activo' : 'Inactivo' }} </label>
                        </div>

                        <div class="col-sm-12">
                            <Textarea
                                label="Descripción del evento"
                                name="descripcion"
                                :errors="form.errors.descripcion"
                                v-model="form.descripcion"
                            />
                        </div>

                        <div class="col-sm-12">
                            <Textarea
                                label="Ubicación del evento"
                                name="ubicacion"
                                :errors="form.errors.ubicacion"
                                v-model="form.ubicacion"
                            />
                        </div>

                        <div class="col-sm-12 col-md-6 mb-4">
                            <Calendar
                                label="Fecha del evento"
                                name="fecha_evento"
                                :errors="form.errors.fecha_evento"
                                v-model="form.fecha_evento"
                            />
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <InputNumber
                                label="Capacidad"
                                name="capacidad"
                                :errors="form.errors.capacidad"
                                v-model="form.capacidad"
                                :useGrouping="false"
                            />
                        </div>

                        <div class="mb-4 col-md-12">
                            <FileUpload
                                dropText="Arrastre aquí la foto del evento."
                                :imagenActual="imagenActual"
                                v-model="form.fotografia"
                                :errors="form.errors.fotografia"
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
import Checkbox from "primevue/checkbox";

// Layouts
import GenericModal from "@/Components/GenericModal.vue";

// Inputs
import InputText from "@/Components/Forms/InputText.vue";
import Dropdown from "@/Components/Forms/Dropdown.vue";
import InputNumber from "@/Components/Forms/InputNumber.vue";
import FileUpload from "@/Components/Forms/FileUpload.vue";
import Calendar from "@/Components/Forms/Calendar.vue";
import Textarea from "@/Components/Forms/Textarea.vue";

const imagenActual = ref(null)

const form = useForm({
    _method: null,
    
    id_usuario: null,
    nombre: null,
    descripcion: null,
    ubicacion: null,
    fecha_evento: null,
    capacidad: null,
    registrados: null,
    fotografia: null,
    status: null,
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
        })).post(route(ruta.value), {
            onSuccess: () => {
                closeModal();
            },
        });

    } else {
        form.transform((data) => ({
            ...data,
            sexo : genero_seleccionado.value?.id,
        })).put(route(ruta.value, props.data_modal.data_registro), {
            onSuccess: () => {
                closeModal();
            },
        });
    }
};

// Watchers
watch(() => props.data_modal, async (newVal) => {
    ruta.value = !newVal.data_registro ? 'eventos.store' : 'eventos.update'
    titulo.value = !newVal.data_registro ? 'Nuevo evento' : 'Actualizar evento'
})

watch(() => props.data_modal.data_registro, (newVal) => {
    form.reset()
    
    console.log(newVal)

    form._method = newVal ? "put" : null

    form.id_usuario = newVal?.id_usuario ?? null
    form.nombre = newVal?.nombre ?? null
    form.descripcion = newVal?.descripcion ?? null
    form.ubicacion = newVal?.ubicacion ?? null
    form.fecha_evento = newVal?.fecha_evento ?? null
    form.capacidad = newVal?.capacidad ?? null
    form.registrados = newVal?.registrados ?? null
    form.status = newVal?.status ?? null
    form.fotografia = newVal?.fotografia ?? null
    imagenActual.value = newVal?.fotografia ?? null
    
    // genero_seleccionado.value = generos.value.find(el => el.id = newVal?.sexo) 
    
})
</script>
