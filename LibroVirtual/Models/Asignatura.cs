using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.ComponentModel.DataAnnotations;

namespace LibroVirtual.Models
{
    public class Asignatura
    {
        public int Id { get; set; }
        public string Nombre { get; set; }
        [Display(Name = "Horas Semanales")]
        public int HorasSemanales { get; set; }
        public int RefCurso { get; set; }
        
        public Asignatura(string nombre, int horassemanales, int refcurso)
        {
            Nombre = nombre;
            HorasSemanales = horassemanales;
            RefCurso = refcurso;
        }

        public Asignatura(int id, string nombre, int horassemanales, int refcurso)
        {
            Id = id;
            Nombre = nombre;
            HorasSemanales = horassemanales;
            RefCurso = refcurso;
        }

        public Asignatura()
        {

        }

    }

}
