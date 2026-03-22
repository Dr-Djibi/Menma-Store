@extends('layouts.admin')

@section('content')
<div class="edit-container">
    <h2>⚙️ Réglages Généraux</h2>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="admin-form" enctype="multipart/form-data">
        @csrf
        <div class="admin-card">
            <h3>Identité Visuelle & PWA</h3>
            <div class="form-group">
                <label>Logo de la Boutique</label>
                <input type="file" name="shop_logo" accept="image/*" onchange="updatePreview(this, 'preview_logo')">
                <div class="mt-10">
                    <img id="preview_logo" src="{{ $settings['shop_logo'] ?? '' }}" style="max-height: 80px; border-radius: 8px; border: 1px solid #ddd; display: {{ !empty($settings['shop_logo']) ? 'block' : 'none' }};">
                </div>
            </div>
            <div class="form-group">
                <label>Icône de l'App (PWA - 512x512 recommandé)</label>
                <input type="file" name="pwa_icon" accept="image/*" onchange="updatePreview(this, 'preview_icon')">
                <div class="mt-10">
                    <img id="preview_icon" src="{{ $settings['pwa_icon'] ?? '' }}" style="max-height: 80px; border-radius: 8px; border: 1px solid #ddd; display: {{ !empty($settings['pwa_icon']) ? 'block' : 'none' }};">
                </div>
            </div>
            <div class="form-group">
                <label>Couleur du thème PWA (Barre d'état mobile)</label>
                <input type="color" name="settings[pwa_theme_color]" value="{{ $settings['pwa_theme_color'] ?? '#ffffff' }}">
            </div>
        </div>

        <div class="admin-card mt-20">
            <h3>Informations sur la Boutique</h3>
            <div class="form-group">
                <label>Nom de la boutique</label>
                <input type="text" name="settings[shop_name]" value="{{ $settings['shop_name'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>Numéro WhatsApp</label>
                <input type="text" name="settings[whatsapp_number]" value="{{ $settings['whatsapp_number'] ?? '' }}">
            </div>
        </div>

        <div class="admin-card mt-20">
            <h3>Apparence (Public)</h3>
            <div class="form-group">
                <label>Titre Hero</label>
                <input type="text" name="settings[hero_title]" value="{{ $settings['hero_title'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>Sous-titre Hero</label>
                <input type="text" name="settings[hero_subtitle]" value="{{ $settings['hero_subtitle'] ?? '' }}">
            </div>
        </div>

        <div class="admin-card mt-20">
            <h3>Interface Admin</h3>
            <div class="form-group">
                <label>Nom de l'application Admin</label>
                <input type="text" name="settings[admin_app_name]" value="{{ $settings['admin_app_name'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>Couleur du thème Admin</label>
                <input type="color" name="settings[admin_theme_color]" value="{{ $settings['admin_theme_color'] ?? '#2b6cb0' }}">
            </div>
        </div>

        <div class="actions-row mt-20">
            <button type="submit" class="btn-save">ENREGISTRER LES RÉGLAGES</button>
        </div>
    </form>
</div>
@endsection
