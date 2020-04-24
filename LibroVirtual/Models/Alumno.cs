using System;
using System.Collections.Generic;
using System.Linq;
using System.ComponentModel.DataAnnotations;
using System.Threading.Tasks;

namespace LibroVirtual.Models
{
    public class Alumno
    {
        [Display(Name="RUT")]
        public string Id { get; set; }
        [Display(Name = "Apellido Paterno")]
        public string ApellidoPaterno { get; set; }
        [Display(Name = "Apellido Materno")]
        public string ApellidoMaterno { get; set; }
        public string Nombres { get; set; }
        public string Sexo { get; set; }
        [DataType(DataType.Date)]
        [Display(Name = "Fecha de Nacimiento")]
        public DateTime FechaNacimiento { get; set; }
        public string Direccion { get; set; }
        public string Comuna { get; set; }
        public string Procedencia { get; set; }

        public int RefCurso { get; set; }

        public Alumno(string id, string apellidoPaterno, string apellidoMaterno, string nombres, string sexo, DateTime fechaNacimiento, string direccion, string comuna, string procedencia, int refcurso)
        {
            Id = id;
            ApellidoPaterno = apellidoPaterno;
            ApellidoMaterno = apellidoMaterno;
            Nombres = nombres;
            Sexo = sexo;
            FechaNacimiento = fechaNacimiento;
            Direccion = direccion;
            Comuna = comuna;
            Procedencia = procedencia;
            RefCurso = refcurso;
        }

        public Alumno(string apellidoPaterno, string apellidoMaterno, string nombres, string sexo, DateTime fechaNacimiento, string direccion, string comuna, string procedencia, int refcurso)
        {
            ApellidoPaterno = apellidoPaterno;
            ApellidoMaterno = apellidoMaterno;
            Nombres = nombres;
            Sexo = sexo;
            FechaNacimiento = fechaNacimiento;
            Direccion = direccion;
            Comuna = comuna;
            Procedencia = procedencia;
            RefCurso = refcurso;
        }

        public Alumno()
        {

        }
    }
}
