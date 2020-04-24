using System;
using System.Collections.Generic;
using System.Linq;
using System.ComponentModel.DataAnnotations;
using System.Threading.Tasks;

namespace LibroVirtual.Models
{
    public class Curso
    {
        public int Id { get; set; }
        public int Nivel { get; set; }
        public string Nombre { get; set; }
        public string Letra { get; set; }
        [Display(Name = "Año")]
        public int Anio { get; set; }

        public Curso(int id, int nivel, string nombre, string letra, int anio)
        {
            Id = id;
            Nivel = nivel;
            Nombre = nombre;
            Letra = letra;
            Anio = anio;
        }
        
        public Curso(int nivel, string nombre, string letra, int anio)
        {
            Nivel = nivel;
            Nombre = nombre;
            Letra = letra;
            Anio = anio;
        }

        public Curso()
        {

        }

    }
}
