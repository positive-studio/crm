@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.products.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.products.title') }}</h1>
            </div>

            <div class="page-action">
                <button class="btn btn-md btn-primary" @click="openModal('addProductModal')">{{ __('admin::app.products.add-title') }}</button>
            </div>
        </div>

        <div class="page-content">
            
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="post" @submit.prevent="onSubmit">
        <modal id="addProductModal" :is-open="modalIds.addProductModal">
            <h3 slot="header-title">{{ __('admin::app.products.add-title') }}</h3>
            
            <div slot="header-actions">
                <button class="btn btn-sm btn-secondary-outline" @click="closeModal('addProductModal')">{{ __('admin::app.products.cancel') }}</button>

                <button class="btn btn-sm btn-primary">{{ __('admin::app.products.save-btn-title') }}</button>
            </div>

            <div slot="body">
                @csrf()
                
                <input type="hidden" name="quick_add" value="1"/>

                @include('admin::common.custom-attributes.edit', [
                    'customAttributes' => app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                        'entity_type' => 'products',
                        'quick_add'   => 1
                    ])
                ])
            </div>
        </modal>
    </form>
@stop