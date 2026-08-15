import os

controllers = {
    'PendidikanController.php': ('Pendidikan', 'pendidikan', 'pendidikan'),
    'PenelitianController.php': ('Penelitian', 'penelitian', 'penelitian'),
    'PengabdianController.php': ('Pengabdian', 'pengabdian', 'pengabdian'),
    'PenunjangController.php': ('Penunjang', 'penunjang', 'penunjang'),
    'KewajibanKhususController.php': ('KewajibanKhusus', 'kewajibankhusus', 'kewajibankhusus')
}

for file_name, (model, var_name, route) in controllers.items():
    path = f'app/Http/Controllers/{file_name}'
    if not os.path.exists(path):
        continue
        
    with open(path, 'r') as f:
        content = f.read()
        
    if 'public function edit' in content:
        continue
        
    methods = f"""
    public function edit({model} ${var_name})
    {{
        if (${var_name}->user_id != Auth::id()) abort(403);
        return view('{route}.edit', compact('{var_name}'));
    }}

    public function update(Request $request, {model} ${var_name})
    {{
        if (${var_name}->user_id != Auth::id()) abort(403);
        
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'semester' => 'nullable|string',
            'volume' => 'required|numeric',
            'angka_kredit' => 'required|numeric',
        ]);
        
        $data = $request->all();
        $data['jumlah_angka_kredit'] = $data['volume'] * $data['angka_kredit'];
        
        ${var_name}->update($data);
        
        return redirect()->route('{route}.index')->with('success', 'Data berhasil diperbarui');
    }}
}}
"""
    # Replace the last closing brace with the new methods
    content = content.rstrip()
    if content.endswith('}'):
        content = content[:-1] + methods
    
    with open(path, 'w') as f:
        f.write(content)

print("Patch applied to all controllers.")
