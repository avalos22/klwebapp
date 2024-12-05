<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create FTL Shipment') }}
        </h2>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 p-2">
                @csrf

                <!-- Customer Info -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-2 p-2">
                        <div class="divisor mt-5 md:col-span-12">
                            <h2 class="text-red-500  font-bold mb-1">Customer
                                <span class="text-black font-bold">Info</span>
                            </h2>
                            <hr>
                        </div>
                        <div class="mt-2 md:col-span-3">
                            <x-label for="customer" :value="__('Customer')" class="text-xs" />
                            <select id="customer" name="customer"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="selectcustomer">Select customer</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="rate_to_customer" :value="__('Rate C.')" class="text-xs" />
                            <x-input id="rate_to_customer" type="text" name="rate_to_customer"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-1">
                            <x-label for="currency" :value="__('Currency')" class="text-xs" />
                            <select id="currency" name="currency"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="USD">USD</option>
                                <option value="MXN">MXN</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="billing_currency_reference" :value="__('Biling C. Ref.')" class="text-xs" />
                            <x-input id="billing_currency_reference" type="text" name="billing_currency_reference"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="pickup_number" :value="__('Pickup No.')" class="text-xs" />
                            <x-input id="pickup_number" type="text" name="pickup_number" class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="shipment_status" :value="__('Shipment Status')" class="text-xs" />
                            <select id="shipment_status" name="shipment_status"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="USD">USD</option>
                                <option value="MXN">MXN</option>
                            </select>
                        </div>
                        <!-- Service Data and Cargo -->

                        <div class="divisor mt-5 md:col-span-12">
                            <h2 class="text-red-500  font-bold mb-1">Service
                                <span class="text-black font-bold">Data</span>
                            </h2>
                            <hr>
                        </div>
                        <div class="mt-2 md:col-span-3">
                            <x-label for="service_type" :value="__('Select new shipment type')" class="text-xs" />
                            <select id="service_type" name="service_type"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="FTL">FTL</option>
                                <option value="LTL">LTL</option>
                                <option value="container_drayage">C. Drayage</option>
                                <option value="hand_carrier">H. Carrier</option>
                                <option value="trailer_rental">Trailer Rental</option>
                                <option value="charter">Charter</option>
                                <option value="air_freight">Air Freight</option>
                                <option value="warehouse">Warehouse</option>
                                <option value="customs_broker">C. Broker</option>
                                <option value="distribution_transfer">D. Transfer</option>
                            </select>
                        </div>
                        <div class="mt-8 md:col-span-4">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox text-green-500 rounded focus:ring-0"
                                        checked>
                                    <span class="text-gray-700">Expedited</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox text-green-500 rounded focus:ring-0"
                                        checked>
                                    <span class="text-gray-700">Hazmat</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="UN_number" :value="__('UN Number')" class="text-xs" />
                            <x-input id="UN_number" type="text" name="UN_number" class="mt-1 block w-full" />
                        </div>

                        <div class="divisor mt-5 md:col-span-12">
                            <h2 class="text-red-500  font-bold mb-1">Cargo
                            </h2>
                            <hr>
                        </div>
                        <div class="mt-2 md:col-span-3">
                            <x-label for="handling_type" :value="__('Handling Type')" class="text-xs" />
                            <select id="handling_type" name="handling_type"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="FTL">Select Handling Type</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-3">
                            <x-label for="material_type" :value="__('Material Type')" class="text-xs" />
                            <select id="material_type" name="material_type"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="FTL">Select Material Type</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="class" :value="__('Class')" class="text-xs" />
                            <select id="class" name="class"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="FTL">Select Class</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-4">
                            <div x-data="{ on: false }" class="mt-6 flex items-center space-x-2">
                                <div class="flex items-center">
                                    <label class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" x-model="on" class="sr-only">
                                            <div class="block bg-gray-300 w-12 h-5 rounded-full"
                                                :class="{ 'bg-green-600': on }"></div>
                                            <div class="dot absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition"
                                                :class="{ 'transform translate-x-6': on }"></div>
                                        </div>
                                        <span class="ml-3 text-gray-700 font-medium text-xs">Stackable</span>
                                    </label>
                                </div>
                                <span class="text-gray-700 font-medium text-xs" x-text="on ? 'YES' : 'NO'"></span>
                            </div>
                        </div>
                        <div class="mt-2 md:col-span-1">
                            <x-label for="cargo_weight" :value="__('Weight')" class="text-xs" />
                            <x-input id="cargo_weight" type="text" name="cargo_weight" placeholder="Weight"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="cargo_uom" :value="__('UOM')" class="text-xs" />
                            <select id="cargo_uom" name="cargo_uom"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800">
                                <option value="uom">uom</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-1">
                            <x-label for="cargo_large" :value="__('Large')" class="text-xs" />
                            <x-input id="cargo_large" type="text" name="cargo_large" placeholder="Large"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-1">
                            <x-label for="cargo_width" :value="__('Width')" class="text-xs" />
                            <x-input id="cargo_width" type="text" name="cargo_width" placeholder="Width"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-1">
                            <x-label for="cargo_height" :value="__('height')" class="text-xs" />
                            <x-input id="cargo_height" type="text" name="cargo_height" placeholder="height"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="cargo_uom" :value="__('UOM')" class="text-xs" />
                            <select id="cargo_uom" name="cargo_uom"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800">
                                <option value="uom">uom</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-2">
                            <x-label for="cargo_yards" :value="__('yards')" class="text-xs" />
                            <x-input id="cargo_yards" type="text" name="cargo_yards" placeholder="Total Yards"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="divisor mt-5 md:col-span-12">
                            <h2 class="text-red-500  font-bold mb-1">Additional
                            </h2>
                            <hr>
                        </div>
                        <div class="mt-2 md:col-span-3">
                            <x-label for="aditiona_accesorials" :value="__('Accesorials')" class="text-xs" />
                            <select id="aditiona_accesorials" name="aditiona_accesorials"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800">
                                <option value="select_accesorials">Select Accesorials</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-4">
                            <x-label for="additional_description" :value="__('Description')" class="text-xs" />
                            <x-input id="additional_description" type="text" name="additional_description"
                                placeholder="Description" class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-1">
                            <x-label for="additional_cost" :value="__('Cost')" class="text-xs" />
                            <x-input id="additional_cost" type="text" name="additional_cost" placeholder="Cost"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-6 md:col-span-1 text-xs">
                            <label class="flex mb-1 items-center space-x-1">
                                <input type="checkbox" class="form-checkbox text-green-500 rounded focus:ring-0"
                                    checked>
                                <span class="text-gray-700">+ IVA</span>
                            </label>
                            <label class="flex items-center space-x-1">
                                <input type="checkbox" class="form-checkbox text-green-500 rounded focus:ring-0"
                                    checked>
                                <span class="text-gray-700">- RET</span>
                            </label>
                        </div>
                        <div class="mt-7 md:col-span-3 text-xs">
                            <button @click="on = true"
                                class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-700">Add</button>
                            <button @click="on = false"
                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">Erase</button>
                        </div>
                        <div class="divisor mt-5 md:col-span-12">
                            <h2 class="text-red-500  font-bold mb-1">Us Broker
                            </h2>
                            <hr>
                        </div>
                        <div class="mt-2 md:col-span-7">
                            <x-label for="us_broker" :value="__('Us Broker')" class="text-xs" />
                            <select id="us_broker" name="us_broker"
                                class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md text-xs text-gray-800 placeholder:text-gray-400">
                                <option value="select_supplier">Bond Number</option>
                            </select>
                        </div>
                        <div class="mt-2 md:col-span-3">
                            <x-label for="bond_number" :value="__('Cost')" class="text-xs" />
                            <x-input id="bond_number" type="text" name="bond_number" placeholder="Cost"
                                class="mt-1 block w-full" />
                        </div>
                        <div class="mt-2 md:col-span-6">
                            <div class="divisor mt-5 md:col-span-6">
                                <h2 class="text-red-500  font-bold mb-1">Shipper
                                </h2>
                                <hr>
                            </div>
                        </div>
                        <div class="mt-2 md:col-span-6">
                            <div class="divisor mt-5 md:col-span-6">
                                <h2 class="text-red-500  font-bold mb-1">Consignee
                                </h2>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Shipment Review -->
                <div class="lg:col-span-5">
                    {{-- aqui vamos a poner un componente para cargar lo que vamos poniendo en los inputs --}}
                    <x-label :value="__('Review')" class="font-bold" />
                    <div class="border p-4">
                        <p><strong>{{ __('Shipment ID:') }}</strong> KLCV314</p>
                        <p><strong>{{ __('Status:') }}</strong> Scheduled</p>
                        <!-- More details -->
                    </div>
                </div>

                {{-- <!-- Additional Data -->
                        <div class="lg:col-span-12">
                            <x-label :value="__('Additional Data')" class="font-bold mt-6" />
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <!-- Add fields for additional data -->
                            </div>
                        </div> --}}

                <!-- Submit Button -->
                <div class="md:col-span-12 mt-2 ml-auto">
                    <x-button class="w-full flex items-center justify-center">
                        {{ __('Create Shipment') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
