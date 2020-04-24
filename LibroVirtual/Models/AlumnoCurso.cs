using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace LibroVirtual.Models
{
    public class AlumnoCurso
    {
        public int Id { get; set; }
        public int RefCurso { get; set; }
        public string RefAlumno { get; set; }

        public AlumnoCurso(int refcurso, string refalumno)
        {
            RefCurso = refcurso;
            RefAlumno = refalumno;
        }

        public AlumnoCurso()
        {

        }
    }
}
