import sqlite3
import pandas as pd
from datetime import datetime

excel_file = "../DUPAK_Laporan_Bersih_1786640989.xlsx"
db_path = "database/database.sqlite"

conn = sqlite3.connect(db_path)
cursor = conn.cursor()

user_id = 1

mappings = {
    'Pendidikan': 'pendidikans',
    'Penelitian': 'penelitians',
    'Pengabdian': 'pengabdians',
    'Penunjang': 'penunjangs'
}

now = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

# Kosongkan data lama milik user ini
for table in mappings.values():
    cursor.execute(f"DELETE FROM {table} WHERE user_id = ?", (user_id,))
conn.commit()

# Masukkan data baru dari Excel
for sheet, table in mappings.items():
    print(f"Seeding {table} from {sheet} sheet...")
    try:
        df = pd.read_excel(excel_file, sheet_name=sheet, header=None)
        inserted_count = 0
        
        for idx, row in df.iterrows():
            if idx < 2: # Skip judul dan header
                continue
                
            no = str(row[0]).strip()
            if not no or no == 'nan':
                continue
                
            uraian = str(row[1]) if not pd.isna(row[1]) else ""
            semester = str(row[2]) if not pd.isna(row[2]) else ""
            
            try: volume = float(row[3])
            except: volume = 0.0
            
            try: angka_kredit = float(row[4])
            except: angka_kredit = 0.0
            
            jumlah_ak = volume * angka_kredit
            
            keterangan = str(row[6]) if not pd.isna(row[6]) else ""
            if keterangan == 'nan': keterangan = ""
            
            cursor.execute(f'''
                INSERT INTO {table} 
                (user_id, uraian_kegiatan, semester, volume, angka_kredit, jumlah_angka_kredit, keterangan, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ''', (user_id, uraian, semester, volume, angka_kredit, jumlah_ak, keterangan, now, now))
            inserted_count += 1
            
        print(f"  -> Inserted {inserted_count} rows into {table}.")
    except Exception as e:
        print(f"Error seeding {table}: {e}")

conn.commit()
conn.close()
print("\nSeeding completed successfully!")
