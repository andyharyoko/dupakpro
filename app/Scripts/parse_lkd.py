import pdfplumber
import json
import sys
import re

def parse_pdf(path, original_filename=""):
    all_data = []
    
    # Try to extract semester from the filename if available
    # usually format is: Andy LKD - 0726047704 TA 2022_2023 Ganjil.pdf
    semester_info = 'Tanpa Semester'
    
    match = re.search(r'TA (\d{4}_\d{4}) (Ganjil|Genap)', original_filename)
    if match:
        semester = match.group(1).replace('_', '/')
        semester_info = f'TA {semester} {match.group(2)}'
    else:
        # fallback search on the path
        match2 = re.search(r'TA (\d{4}_\d{4}) (Ganjil|Genap)', path)
        if match2:
            semester = match2.group(1).replace('_', '/')
            semester_info = f'TA {semester} {match2.group(2)}'
            
    try:
        with pdfplumber.open(path) as pdf:
            current_category = 'Umum'
            for page in pdf.pages:
                text = page.extract_text()
                if text:
                    if 'I. Unsur Pelaksanaan Pendidikan' in text:
                        current_category = 'Pendidikan'
                    elif 'II. Unsur Pelaksanaan Penelitian' in text:
                        current_category = 'Penelitian'
                    elif 'III. Unsur Pelaksanaan Pengabdian' in text:
                        current_category = 'Pengabdian'
                    elif 'IV. Unsur Pelaksanaan Penunjang' in text:
                        current_category = 'Penunjang'
                    elif 'V. Kewajiban Khusus' in text:
                        current_category = 'KewajibanKhusus'
                        
                tables = page.extract_tables()
                for table in tables:
                    for row in table:
                        cleaned_row = [str(cell).replace('\n', ' ').strip() if cell else '' for cell in row]
                        # Skip headers or empty rows
                        if not any(cleaned_row) or cleaned_row[0].lower() == 'no' or 'Capaian' in cleaned_row[0]:
                            continue
                            
                        # Activity rows start with a number
                        if re.match(r'^\d+$', cleaned_row[0]):
                            kegiatan = cleaned_row[1] if len(cleaned_row) > 1 else ''
                            sks = cleaned_row[7] if len(cleaned_row) > 7 else '0'
                            
                            # Clean up SKS (e.g. replace comma with dot)
                            sks = sks.replace(',', '.')
                            try:
                                sks_float = float(sks)
                            except ValueError:
                                sks_float = 0.0
                                
                            all_data.append({
                                'semester': semester_info,
                                'kategori': current_category,
                                'kegiatan': kegiatan,
                                'sks': sks_float
                            })
    except Exception as e:
        print(json.dumps({'error': str(e)}))
        sys.exit(1)
    
    print(json.dumps(all_data))

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print(json.dumps({'error': 'Missing PDF file path'}))
        sys.exit(1)
        
    pdf_path = sys.argv[1]
    original_name = sys.argv[2] if len(sys.argv) > 2 else pdf_path
    parse_pdf(pdf_path, original_name)
