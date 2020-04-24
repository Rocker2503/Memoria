using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using LibroVirtual.Models;
using Microsoft.EntityFrameworkCore;

namespace LibroVirtual.Data
{
    public class LibroContext : DbContext
    {
        public LibroContext(DbContextOptions<LibroContext> options)
            : base(options) { }

        public DbSet<Curso> Curso { get; set; }
        public DbSet<Asignatura> Asignatura { get; set; }
        public DbSet<Alumno> Alumno { get; set; }
    }
}
